<?php

/**
 * Syntax description: http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules
 * Rules reference: https://unicode-org.github.io/cldr-staging/charts/latest/supplemental/language_plural_rules.html
 */

declare(strict_types=1);

namespace Major\PluralRules\Dev\Tests;

use Exception;
use Major\PluralRules\Dev\Helpers as H;
use Nette\PhpGenerator as Gen;
use PHPUnit\Framework\Attributes\DataProvider;
use Psl\Str;
use Psl\Vec;

final class TestCompiler
{
    public function __construct(
        private string $locale,
        /** @var array<string, string> */
        private array $rules,
    ) { }

    public function compile(): void
    {
        $samples = [];

        foreach ($this->rules as $category => $rule) {
            $category = Str\strip_prefix($category, 'pluralRule-count-');

            if (null === $sampleList = Str\after($rule, '@')) {
                continue;
            }

            $samples[$category] = $this->compileSamples($sampleList);
        }

        $name = H\studly($this->locale, 'test');

        $compiled = $this->compileTests($this->locale, $name, $samples);

        H\LocaleFiles::write('tests', $name, $compiled);
    }

    /**
     * @param array<string, list<string>> $samples
     */
    private function compileTests(string $locale, string $name, array $samples): string
    {
        if ($samples === []) {
            throw new Exception('No samples!');
        }

        $file = new Gen\PhpFile();

        $namespace = $file->addNamespace('Major\\PluralRules\\Tests\\Locale')
            ->addUse(\Major\PluralRules\PluralRules::class)
            ->addUse(\PHPUnit\Framework\Attributes\DataProvider::class)
            ->addUse(\PHPUnit\Framework\TestCase::class);

        $class = $namespace->addClass($name)
            ->setFinal()
            ->setExtends(\PHPUnit\Framework\TestCase::class);

        foreach ($samples as $category => $categorySamples) {
            $this->compileTest($class, $locale, $category, $categorySamples);
        }

        return (new Gen\PsrPrinter())->printFile($file);
    }

    /**
     * @param list<string> $samples
     */
    public function compileTest(
        Gen\ClassType $class,
        string $locale,
        string $category,
        array $samples,
    ): void {
        $providerName = H\camel('provide', $category, 'cases');

        $test = $class->addMethod(H\camel('test', $category))
            ->addAttribute(DataProvider::class, [$providerName])
            ->setReturnType('void')
            ->addBody('$category = PluralRules::select(?, $num);', [$locale])
            ->addBody('$this->assertSame(?, $category);', [$category]);

        $test->addParameter('num')->setType('int|float|string');

        $samples = Vec\map($samples, fn (string $sample) => "    {$sample},");
        $samples = Str\join($samples, "\n");

        $class->addMethod($providerName)
            ->setStatic()
            ->addComment('@return list<array{int|float|string}>')
            ->setReturnType('array')
            ->addBody("return [\n{$samples}\n];");
    }

    /**
     * Only the endpoints of sample ranges are used.
     *
     * @return list<string>
     */
    private function compileSamples(string $sampleList): array
    {
        $output = [];

        // `integer 0, 2~16, 1c6, … @decimal 0.0~1.5, 10.0, …`
        foreach (Str\split($sampleList, '@') as $section) {
            if (preg_match('/^(?:integer|decimal) (.+)$/', Str\trim($section), $match) !== 1) {
                throw new Exception("Invalid samples: {$section}");
            }

            foreach (Str\split($match[1], ',') as $range) {
                $range = Str\trim($range);

                if ($range === '…' || $range === '...') {
                    continue;
                }

                foreach (Str\split($range, '~') as $value) {
                    $output[] = $this->compileValue($value);
                }
            }
        }

        return Vec\map(
            Vec\filter_nulls($output),
            fn (string $s) => "[{$s}]",
        );
    }

    private function compileValue(string $value): ?string
    {
        if (preg_match('/^[0-9]+(\\.[0-9]+)?([ce][1-9][0-9]*)?$/', $value) !== 1) {
            throw new Exception("Invalid sample: {$value}");
        }

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
