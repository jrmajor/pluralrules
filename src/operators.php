<?php

declare(strict_types=1);

namespace Major\PluralRules\Operators;

/**
 * @internal
 */
function mod(int|float $number, int $divisor): float
{
    return $number % $divisor + $number - round($number);
}

/**
 * @internal
 */
function in_range(int|float $number, int $from, int $to): bool
{
    if ($number - round($number) !== 0.0) {
        return false;
    }

    return $number >= $from && $number <= $to;
}
