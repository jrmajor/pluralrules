<?php

/**
 * Syntax description: http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules
 * JSON Rules: https://github.com/unicode-org/cldr-json/blob/master/cldr-json/cldr-core/supplemental/plurals.json
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

/**
 * Debugging helper, dumps TreeNode object.
 */
function da(\Hoa\Compiler\Llk\TreeNode $ast): void
{
    echo (new \Hoa\Compiler\Visitor\Dump())->visit($ast);

    exit(1);
}

$start = microtime(true);

foreach ((new Finder())->in([
    __DIR__ . '/../rules',
    __DIR__ . '/../tests/Locale',
]) as $file) {
    unlink($file->getRealPath() ?: throw new Exception("{$file} does not exist."));
}

$locales = json_decode(
    file_get_contents(__DIR__.'/../data/plurals.json') ?: throw new Exception(),
    associative: true,
)['supplemental']['plurals-type-cardinal'];

$locales = array_chunk($locales, 50, preserve_keys: true);

$tasks = [];

foreach ($locales as $chunk) {
    $tasks[] = fn () => RuleCompiler::make($chunk);
    $tasks[] = fn () => TestCompiler::make($chunk);
}

Fork::new()->run(...$tasks);

echo 'Generated in ' . round(microtime(true) - $start, 2) . "s\n";
