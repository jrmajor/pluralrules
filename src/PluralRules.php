<?php

/**
 * Syntax description: http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules
 * JSON Rules: https://github.com/unicode-org/cldr-json/blob/master/cldr-json/cldr-core/supplemental/plurals.json
 * Rules reference: https://unicode-org.github.io/cldr-staging/charts/latest/supplemental/language_plural_rules.html
 */

namespace Major\PluralRules;

use Closure;
use Locale;

final class PluralRules
{
    /** @var array<string, array<string, Closure>> */
    protected static array $rules = [];

    protected function __construct() { }

    public static function select(string $locale, int|float|string $number): string
    {
        $number = is_float($number) && $number - round($number) === 0.0
            ? (string) $number . '.0'
            : (string) $number;

        foreach (self::rulesFor($locale) as $category => $rule) {
            if ($rule($number)) {
                return $category;
            }
        }

        return 'other';
    }

    /**
     * @return array<string, Closure>
     */
    protected static function rulesFor(string $locale): array
    {
        $locale = Locale::getPrimaryLanguage($locale);

        if (array_key_exists($locale, self::$rules)) {
            return self::$rules[$locale];
        }

        file_exists($filename = __DIR__."/../rules/{$locale}.php")
            ?: throw new LocaleNotFound();

        return self::$rules[$locale] = require $filename;
    }
}
