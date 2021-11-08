<?php

/**
 * Syntax description: http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules
 * Rules reference: https://unicode-org.github.io/cldr-staging/charts/latest/supplemental/language_plural_rules.html
 */

declare(strict_types=1);

namespace Major\PluralRules;

use Exception;
use Spatie\Fork\Fork;
use Symfony\Component\Finder\Finder;

require __DIR__ . '/../vendor/autoload.php';

// Register error handler
(new \NunoMaduro\Collision\Provider())->register();

$start = microtime(true);

foreach ((new Finder())->in([
    __DIR__ . '/../rules',
    __DIR__ . '/../tests/Locale',
]) as $file) {
    unlink($file->getRealPath() ?: throw new Exception("{$file} does not exist."));
}

$locales = file_get_contents(__DIR__ . '/../node_modules/cldr-core/supplemental/plurals.json')
    ?: throw new Exception('plurals.json does not exist.');

/** @@phpstan-ignore-next-line */
$locales = json_decode($locales, associative: true)['supplemental']['plurals-type-cardinal'];

assert(is_array($locales));

$locales = array_chunk($locales, 50, preserve_keys: true);

$tasks = [];

foreach ($locales as $chunk) {
    $tasks[] = fn () => RuleCompiler::make($chunk);
    $tasks[] = fn () => TestCompiler::make($chunk);
}

Fork::new()->run(...$tasks);

echo 'Generated in ' . round(microtime(true) - $start, 2) . "s\n";
