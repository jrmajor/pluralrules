<?php

namespace Major\PluralRules\Dev\Helpers;

use Psl\File;
use Psl\Filesystem;

/**
 * @phpstan-type D = 'rules'|'tests'
 */
final class LocaleFiles
{
    /**
     * @param D $dir
     */
    public static function prepareDirectory(string $dir): void
    {
        $dir = self::path($dir);

        Filesystem\delete_directory($dir, true);
        Filesystem\create_directory($dir);
    }

    /**
     * @param D $dir
     */
    public static function write(string $dir, string $locale, string $content): void
    {
        File\write(self::path($dir, "{$locale}.php"), $content, File\WriteMode::MustCreate);
    }

    /**
     * @param D $dir
     *
     * @return non-empty-string
     */
    private static function path(string $dir, ?string $path = null): string
    {
        return match ($dir) {
            'rules' => __DIR__ . '/../../rules',
            'tests' => __DIR__ . '/../../tests/Locale',
        } . ($path !== null ? '/' . $path : '');
    }
}
