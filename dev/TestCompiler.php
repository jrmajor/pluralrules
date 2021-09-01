<?php

/**
 * Syntax description: http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules
 * Rules reference: https://unicode-org.github.io/cldr-staging/charts/latest/supplemental/language_plural_rules.html
 */

declare(strict_types=1);

namespace Major\PluralRules;

use Exception;
use Hoa\Compiler\Llk\Llk;
use Hoa\Compiler\Llk\Parser;
use Hoa\Compiler\Llk\TreeNode;

final class TestCompiler
{
    private Parser $llk;

    private function __construct()
    {
        $this->llk = Llk::load(
            new \Hoa\File\Read(__DIR__ . '/SampleList.pp'),
        );
    }

    /**
     * @param array<string, array<string, string>> $locales
     */
    public static function make(array $locales): void
    {
        (new self())->makeLocales($locales);
    }

    /**
     * @param array<string, array<string, string>> $locales
     */
    private function makeLocales(array $locales): void
    {
        foreach ($locales as $locale => $rules) {
            if ($locale === 'root') {
                continue;
            }

            $this->makeLocale($locale, $rules);
        }
    }

    /**
     * @param array<string, string> $rules
     */
    private function makeLocale(string $locale, array $rules): void
    {
        $asts = [];

        foreach ($rules as $category => $rule) {
            $category = substr($category, 17);

            if (! str_contains($rule, '@')) {
                continue;
            }

            $samples = strstr($rule, '@') ?: throw new Exception();

            $asts[$category] = $this->llk->parse($samples);
        }

        $filename = implode(array_map(
            fn ($p) => ucfirst(strtolower($p)),
            explode('-', $locale),
        ));

        file_put_contents(
            __DIR__ . "/../tests/Locale/{$filename}Test.php",
            $this->compileTests($locale, $asts),
        ) ?: throw new Exception("Failed to write {$filename}Test.php");
    }

    /**
     * @param array<string, TreeNode> $samples
     */
    private function compileTests(string $locale, array $samples): string
    {
        if (! $samples) {
            throw new Exception('No samples!');
        }

        $compiled = "<?php\n\nuse Major\\PluralRules\\PluralRules;\n";

        foreach ($samples as $category => $sampleList) {
            $sampleList = array_map(
                fn (string $sample) => "    {$sample},",
                $this->compileSamples($sampleList),
            );

            $sampleList = implode("\n", $sampleList);

            $compiled .= "\n" . <<<PHP
                test('{$category}', function (\$num) {
                    \$category = PluralRules::select('{$locale}', \$num);
                    expect(\$category)->toBe('{$category}');
                })->with([
                {$sampleList}
                ]);
                PHP . "\n";
        }

        return "{$compiled}";
    }

    /**
     * @return string[]
     */
    private function compileSamples(TreeNode $samples): array
    {
        $output = [];

        foreach ($samples->getChildren() as $sample) {
            if ($sample->isToken() && $sample->getValueToken() === 'value') {
                $output[] = $this->compileValue($sample);

                continue;
            }

            foreach ($sample->getChildren() as $value) {
                $output[] = $this->compileValue($value);
            }
        }

        return array_filter($output);
    }

    private function compileValue(TreeNode $value): ?string
    {
        $value = $value->getValueValue();

        if (str_contains($value, 'c') || str_contains($value, 'e')) {
            return null;
        }

        if (
            str_contains($value, '.')
            && (str_ends_with($value, '0') && ! str_ends_with($value, '.0'))
        ) {
            return "'{$value}'";
        }

        return $value;
    }
}
