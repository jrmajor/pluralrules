<?php

declare(strict_types=1);

namespace Major\PluralRules\Dev\Rules;

use Exception;
use Major\PluralRules\Dev\Helpers as H;
use Psl\Regex;
use Psl\Str;
use Psl\Vec;

/**
 * @see http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules
 * @see https://unicode-org.github.io/cldr-staging/charts/latest/supplemental/language_plural_rules.html
 */
final class RuleCompiler
{
    /** @var array<string, true> */
    private array $operands = [];

    /** @var array<string, true> */
    private array $operators = [];

    public function __construct(
        private string $locale,
        /** @var array<string, string> */
        private array $rules,
    ) { }

    public function compile(): void
    {
        $compiled = [];

        foreach ($this->rules as $category => $rule) {
            $category = Str\strip_prefix($category, 'pluralRule-count-');

            if ($category === 'other') {
                continue;
            }

            $condition = Str\before($rule, '@') ?? $rule;
            $condition = Str\trim(Regex\replace($condition, '/\\s+/', ' '));

            $compiled[$category] = $this->compileCondition($condition);
        }

        H\LocaleFiles::write('rules', $this->locale, $this->compileFile($compiled));
    }

    /**
     * @param array<string, string> $rules
     */
    private function compileFile(array $rules): string
    {
        if ($rules === []) {
            return "<?php\n\nreturn [];\n";
        }

        $compiled = "<?php\n\n{$this->compileImports()}\n\nreturn [\n";

        foreach ($rules as $category => $rule) {
            $compiled .= "    '{$category}' => fn (\$n) => {$rule},\n";
        }

        return "{$compiled}];\n";
    }

    private function compileImports(): string
    {
        $imports = [
            'Operands' => Vec\sort(Vec\keys($this->operands)),
            'Operators' => Vec\sort(Vec\keys($this->operators)),
        ];

        $compiled = [];

        foreach ($imports as $namespace => $functions) {
            $compiled[] = match (count($functions)) {
                0 => null,
                1 => "use function Major\\PluralRules\\{$namespace}\\{$functions[0]};",
                default => "use function Major\\PluralRules\\{$namespace}\\{" . Str\join($functions, ', ') . '};',
            };
        }

        return Str\join(Vec\filter_nulls($compiled), "\n");
    }

    /**
     * `and` binds tighter than `or`, same as `&&` and `||` in PHP.
     */
    private function compileCondition(string $condition): string
    {
        $or = Vec\map(
            Str\split($condition, ' or '),
            fn (string $and) => Str\join(
                Vec\map(Str\split($and, ' and '), $this->compileRelation(...)),
                ' && ',
            ),
        );

        return Str\join($or, ' || ');
    }

    private function compileRelation(string $relation): string
    {
        $matched = preg_match(
            '/^([nifvtwce])(?: (?:%|mod) ([0-9]+))? (!?=) ([0-9., ]+)$/',
            $relation,
            $match,
            PREG_UNMATCHED_AS_NULL,
        );

        if ($matched !== 1) {
            throw new Exception("Invalid relation: {$relation}");
        }

        [, $operand, $mod, $operator, $ranges] = $match;

        $this->operands[$operand] = true;
        $expression = "{$operand}(\$n)";

        if ($mod !== null) {
            $this->operators['mod'] = true;
            $expression = "mod({$expression}, {$mod})";
        }

        $negated = $operator === '!=';
        $ranges = Vec\map(Str\split($ranges, ','), Str\trim(...));

        if (count($ranges) === 1) {
            return $this->compileRange($expression, $ranges[0], $negated);
        }

        $compiled = Vec\map($ranges, fn ($range) => $this->compileRange($expression, $range));

        return ($negated ? '! ' : '') . '(' . Str\join($compiled, ' || ') . ')';
    }

    private function compileRange(string $expression, string $range, bool $negated = false): string
    {
        if (preg_match('/^([0-9]+)(?:\\.\\.([0-9]+))?$/', $range, $match, PREG_UNMATCHED_AS_NULL) !== 1) {
            throw new Exception("Invalid range: {$range}");
        }

        [, $from, $to] = $match;

        if ($to === null) {
            return $expression . ($negated ? ' != ' : ' == ') . $from;
        }

        $this->operators['in_range'] = true;

        return ($negated ? '! ' : '') . "in_range({$expression}, {$from}, {$to})";
    }
}
