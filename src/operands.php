<?php

declare(strict_types=1);

namespace Major\PluralRules\Operands;

/**
 * Absolute value of the source number.
 *
 * @internal
 */
function n(string $number): float
{
    return (float) abs((float) $number);
}

/**
 * Integer digits of n.
 *
 * @internal
 */
function i(string $number): int
{
    return abs((int) $number);
}

/**
 * Number of visible fraction digits in n, with trailing zeros.
 *
 * @internal
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
 *
 * @internal
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
 *
 * @internal
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
 *
 * @internal
 */
function t(string $number): int
{
    return (int) rtrim((string) f($number), '0');
}

/**
 * Compact decimal exponent value.
 *
 * @internal
 */
function c(string $number): int
{
    return 0;
}

/**
 * Synonym for c().
 *
 * @internal
 */
function e(string $number): int
{
    return c($number);
}
