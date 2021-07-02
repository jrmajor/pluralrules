<?php

namespace Major\PluralRules;

use Exception;
use Hoa\Compiler\Llk\Llk;
use Hoa\Compiler\Llk\Parser;
use Hoa\Compiler\Llk\TreeNode;

final class RuleCompiler
{
    protected Parser $llk;

    protected function __construct()
    {
        $this->llk = Llk::load(
            new \Hoa\File\Read(__DIR__ . '/PluralRule.pp'),
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
    protected function makeLocales(array $locales): void
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
    protected function makeLocale(string $locale, array $rules): void
    {
        $asts = [];

        foreach ($rules as $category => $rule) {
            $category = substr($category, 17);

            if ($category === 'other') {
                continue;
            }

            if (str_contains($rule, '@')) {
                $rule = strstr($rule, '@', true) ?: throw new Exception();
            }

            $asts[$category] = $this->llk->parse($rule);
        }

        file_put_contents(
            __DIR__ . "/../rules/{$locale}.php",
            $this->compileRules($asts),
        ) ?: throw new Exception("Failed to write {$locale}.php");
    }

    /**
     * @param array<string, TreeNode> $rules
     */
    protected function compileRules(array $rules): string
    {
        if (! $rules) {
            return "<?php\n\nreturn [];\n";
        }

        $compiled = "<?php\n\n{$this->compileImports($rules)}\n\nreturn [\n";

        foreach ($rules as $category => $rule) {
            $compiled .= "    '{$category}' => fn (\$n) => {$this->compileRule($rule)},\n";
        }

        return "{$compiled}];\n";
    }

    /**
     * @param array<string, TreeNode> $rules
     */
    protected function compileImports(array $rules): string
    {
        $operands = [];
        $inRange = '';

        foreach ($rules as $rule) {
            foreach ($rule->getChildren() as $child) {
                if ($child->getId() !== '#relation') {
                    continue;
                }

                foreach ($child->getChild(2)->getChildren() as $rangeOrValue) {
                    if ($rangeOrValue->getId() === '#range') {
                        $operands[] = 'in_range';
                    }
                }

                $operands[] = $child->getChild(0)->getChild(0)->getValueValue();
            }
        }

        $operands = array_unique($operands);

        sort($operands);

        return match (count($operands)) {
            1 => "use function Major\\PluralRules\\Operands\\{$operands[0]};",
            default => 'use function Major\\PluralRules\\Operands\\{' . implode(', ', $operands) . '};',
        };
    }

    protected function compileRule(TreeNode $rule): string
    {
        $output = '';

        foreach ($rule->getChildren() as $part) {
            $output .= match (
                $part->getValueToken() ?? $part->getId()
            ) {
                '#relation' => $this->compileRelation($part),
                'and' => ' && ',
                'or' => ' || ',
            };
        }

        return $output;
    }

    protected function compileRelation(TreeNode $relation): string
    {
        $negated = false;

        foreach ($relation->getChild(1)->getChildren() as $operator) {
            $negated = match ($operator->getValueToken()) {
                'eq' => $negated,
                'not', 'neq' => ! $negated,
            };
        }

        $expression = $this->compileExpression($relation->getChild(0));

        $compiled = '';

        foreach ($relation->getChild(2)->getChildren() as $key => $range) {
            if ($key !== 0) {
                $compiled .= ' || ';
            }

            if ($range->getValueToken() === 'number') {
                $compiled .= "{$expression} == {$range->getValueValue()}";

                continue;
            }

            $from = $range->getChild(0)->getValueValue();
            $to = $range->getChild(1)->getValueValue();

            $compiled = "in_range({$expression}, {$from}, {$to})";
        }

        return ($negated ? '! (' : '(') . $compiled . ')';
    }

    protected function compileExpression(TreeNode $expression): string
    {
        $operand = $expression->getChild(0)->getValueValue() . '($n)';

        return ! $expression->childExists(1)
            ? $operand
            : $operand . ' % ' . $expression->getChild(1)->getValueValue();
    }
}
