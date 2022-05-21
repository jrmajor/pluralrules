<?php

/**
 * Syntax description: http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules
 * Rules reference: https://unicode-org.github.io/cldr-staging/charts/latest/supplemental/language_plural_rules.html
 */

declare(strict_types=1);

namespace Major\PluralRules\Dev\Compilers;

use Exception;
use Hoa\Compiler\Llk\Llk;
use Hoa\Compiler\Llk\Parser;
use Hoa\Compiler\Llk\TreeNode;
use Major\PluralRules\Dev\Helpers\LocaleFiles;
use Psl\Str;
use Psl\Vec;

final class TestCompiler
{
    private Parser $llk;

    public function __construct(
        private string $locale,
        /** @var array<string, string> */
        private array $rules,
    ) {
        $this->llk = Llk::load(
            new \Hoa\File\Read(__DIR__ . '/../grammars/SampleList.pp'),
        );
    }

    public function compile(): void
    {
        $asts = [];

        foreach ($this->rules as $category => $rule) {
            $category = Str\strip_prefix($category, 'pluralRule-count-');

            if (null === $samples = Str\after($rule, '@')) {
                continue;
            }

            $asts[$category] = $this->llk->parse('@' . $samples);
        }

        $filename = Str\join(Vec\map(
            Str\split($this->locale, '-'),
            fn ($p) => ucfirst(Str\lowercase($p)),
        ), '') . 'Test';

        LocaleFiles::write('tests', $filename, $this->compileTests($this->locale, $asts));
    }

    /**
     * @param array<string, TreeNode> $samples
     */
    private function compileTests(string $locale, array $samples): string
    {
        if ($samples === []) {
            throw new Exception('No samples!');
        }

        $compiled = "<?php\n\nuse Major\\PluralRules\\PluralRules;\n";

        foreach ($samples as $category => $sampleList) {
            $sampleList = Vec\map(
                $this->compileSamples($sampleList),
                fn (string $sample) => "    {$sample},",
            );

            $sampleList = Str\join($sampleList, "\n");

            $compiled .= "\n" . <<<PHP
                test('{$category}', function (\$num) {
                    \$category = PluralRules::select('{$locale}', \$num);
                    expect(\$category)->toBe('{$category}');
                })->with([
                {$sampleList}
                ]);
                PHP . "\n";
        }

        return $compiled;
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

        if (Str\contains($value, 'c') || Str\contains($value, 'e')) {
            return null;
        }

        if (
            Str\contains($value, '.')
            && (Str\ends_with($value, '0') && ! Str\ends_with($value, '.0'))
        ) {
            return "'{$value}'";
        }

        return $value;
    }
}
