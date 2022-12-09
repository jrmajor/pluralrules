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
use Major\PluralRules\Dev\Helpers as H;
use Nette\PhpGenerator as Gen;
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

        $name = H\studly($this->locale, 'test');

        $compiled = $this->compileTests($this->locale, $name, $asts);

        H\LocaleFiles::write('tests', $name, $compiled);
    }

    /**
     * @param array<string, TreeNode> $samples
     */
    private function compileTests(string $locale, string $name, array $samples): string
    {
        if ($samples === []) {
            throw new Exception('No samples!');
        }

        $file = new Gen\PhpFile();

        $namespace = $file->addNamespace('Major\\PluralRules\\Tests\\Locale')
            ->addUse(\Major\PluralRules\PluralRules::class)
            ->addUse(\PHPUnit\Framework\TestCase::class);

        $class = $namespace->addClass($name)
            ->setFinal()
            ->setExtends(\PHPUnit\Framework\TestCase::class);

        foreach ($samples as $category => $sampleList) {
            $samples = $this->compileSamples($sampleList);

            assert(is_string($category));

            $this->compileTest($class, $locale, $category, $samples);
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
            ->addComment("@dataProvider {$providerName}")
            ->setReturnType('void')
            ->addBody('$category = PluralRules::select(?, $num);', [$locale])
            ->addBody('$this->assertSame(?, $category);', [$category]);

        $test->addParameter('num')->setType('int|float|string');

        $samples = Vec\map($samples, fn (string $sample) => "    {$sample},");
        $samples = Str\join($samples, "\n");

        $class->addMethod($providerName)
            ->addComment('@return list<array{int|float|string}>')
            ->setReturnType('array')
            ->addBody("return [\n{$samples}\n];");
    }

    /**
     * @return list<string>
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

        return Vec\map(
            Vec\filter_nulls($output),
            fn (string $s) => "[{$s}]",
        );
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
