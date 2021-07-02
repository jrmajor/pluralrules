<?php

declare(strict_types=1);

namespace Major\PluralRules\Operands;

function in_range(int|float $number, int $from, int $to): bool
{
    if ($number - round($number) !== 0.0) {
        return false;
    }

    return $number >= $from && $number <= $to;
}

/**
 * Absolute value of the source number.
 */
function n(string $number): float
{
    return (float) abs((float) $number);
}

/**
 * Integer digits of n.
 */
function i(string $number): int
{
    return abs((int) $number);
}

/**
 * Number of visible fraction digits in n, with trailing zeros.
 */
function v(string $number): int
{
    return strlen(substr(
        $number,
        (strpos($number, '.') ?: strlen($number)) + 1,
    ));
}

/**
 * Number of visible fraction digits in n, without trailing zeros.
 */
function w(string $number): int
{
    return strlen(rtrim(substr(
        $number,
        (strpos($number, '.') ?: strlen($number)) + 1,
    ), '0'));
}

/**
 * Visible fraction digits in n, with trailing zeros.
 */
function f(string $number): int
{
    return (int) substr(
        $number,
        (strpos($number, '.') ?: strlen($number)) + 1,
    );
}

/**
 * Visible fraction digits in n, without trailing zeros.
 */
function t(string $number): int
{
    return (int) rtrim((string) f($number), '0');
}

/**
 * Compact decimal exponent value.
 */
function c(string $number): int
{
    return 0;
}

/**
 * Synonym for c().
 */
function e(string $number): int
{
    return c($number);
}
