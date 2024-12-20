<?php

declare(strict_types=1);

namespace Major\PluralRules;

use Closure;
use Locale;

final class PluralRules
{
    /** @var array<string, array<string, Closure>> */
    private static array $rules = [];

    private function __construct()
    {
    }

    public static function select(string $locale, int|float|string $number): string
    {
        $number = is_float($number) && $number - round($number) === 0.0
            ? $number . '.0'
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
    private static function rulesFor(string $locale): array
    {
        $lang = Locale::getPrimaryLanguage($locale)
            ?? throw new LocaleNotFound($locale);

        if ($lang === 'pt' && Locale::getRegion($locale) === 'PT') {
            $lang = 'pt-PT';
        }

        if (array_key_exists($lang, self::$rules)) {
            return self::$rules[$lang];
        }

        is_file($filename = __DIR__ . "/../rules/{$lang}.php")
            ?: throw new LocaleNotFound($lang);

        /** @phpstan-ignore return.type, assign.propertyType */
        return self::$rules[$lang] = require $filename;
    }
}
