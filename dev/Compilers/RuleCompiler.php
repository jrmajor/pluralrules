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

final class RuleCompiler
{
    private Parser $llk;

    public function __construct(
        private string $locale,
        /** @var array<string, string> */
        private array $rules,
    ) {
        $this->llk = Llk::load(
            new \Hoa\File\Read(__DIR__ . '/../grammars/PluralRule.pp'),
        );
    }

    public function compile(): void
    {
        $asts = [];

        foreach ($this->rules as $category => $rule) {
            $category = substr($category, 17);

            if ($category === 'other') {
                continue;
            }

            if (str_contains($rule, '@')) {
                $rule = strstr($rule, '@', true) ?: throw new Exception();
            }

            $asts[$category] = $this->llk->parse($rule);
        }

        LocaleFiles::write('rules', $this->locale, $this->compileRules($asts));
    }

    /**
     * @param array<string, TreeNode> $rules
     */
    private function compileRules(array $rules): string
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
    private function compileImports(array $rules): string
    {
        $operands = $operators = [];

        foreach ($rules as $rule) {
            foreach ($rule->getChildren() as $child) {
                if ($child->getId() !== '#relation') {
                    continue;
                }

                if (count($child->getChild(0)->getChildren()) > 1) {
                    $operators[] = 'mod';
                }

                foreach ($child->getChild(2)->getChildren() as $rangeOrValue) {
                    if ($rangeOrValue->getId() === '#range') {
                        $operators[] = 'in_range';
                    }
                }

                $operands[] = $child->getChild(0)->getChild(0)->getValueValue();
            }
        }

        $operands = array_unique($operands);
        $operators = array_unique($operators);

        sort($operands);
        sort($operators);

        $operands = match (count($operands)) {
            1 => "use function Major\\PluralRules\\Operands\\{$operands[0]};",
            default => 'use function Major\\PluralRules\\Operands\\{' . implode(', ', $operands) . '};',
        };

        $operators = match (count($operators)) {
            0 => '',
            1 => "use function Major\\PluralRules\\Operators\\{$operators[0]};",
            default => 'use function Major\\PluralRules\\Operators\\{' . implode(', ', $operators) . '};',
        };

        return trim($operands . "\n" . $operators);
    }

    private function compileRule(TreeNode $rule): string
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

    private function compileRelation(TreeNode $relation): string
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

            $compiled .= "in_range({$expression}, {$from}, {$to})";
        }

        return ($negated ? '! (' : '(') . $compiled . ')';
    }

    private function compileExpression(TreeNode $expression): string
    {
        $operand = $expression->getChild(0)->getValueValue() . '($n)';

        $mod = $expression->getChild(1)?->getValueValue();

        return $mod !== null ? "mod({$operand}, {$mod})" : $operand;
    }
}
