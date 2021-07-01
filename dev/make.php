<?php

/**
 * Syntax description: http://unicode.org/reports/tr35/tr35-numbers.html#Language_Plural_Rules
 * JSON Rules: https://github.com/unicode-org/cldr-json/blob/master/cldr-json/cldr-core/supplemental/plurals.json
 * Rules reference: https://unicode-org.github.io/cldr-staging/charts/latest/supplemental/language_plural_rules.html
 */

declare(strict_types=1);

namespace Major\PluralRules;

use Exception;

require __DIR__.'/../vendor/autoload.php';

// Register nicer error handler
(new \NunoMaduro\Collision\Provider())->register();

/**
 * Debugging helper, dumps TreeNode object.
 */
function da(\Hoa\Compiler\Llk\TreeNode $ast): void
{
    echo (new \Hoa\Compiler\Visitor\Dump())->visit($ast);

    exit(1);
}

$locales = json_decode(
    file_get_contents(__DIR__.'/../data/plurals.json')
        ?: throw new Exception(__DIR__.'/../plurals.json does not exist.'),
    associative: true,
)['supplemental']['plurals-type-cardinal'];

Compiler::make($locales);
