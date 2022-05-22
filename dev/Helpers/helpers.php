<?php

namespace Major\PluralRules\Dev\Helpers;

use Hoa\Compiler;
use Psl\Str;
use Psl\Vec;

/**
 * @no-named-arguments
 */
function studly(string ...$pieces): string
{
    $words = Str\split(Str\replace_every(
        Str\join($pieces, ' '),
        ['-' => ' ', '_' => ' '],
    ), ' ');

    $studlyWords = Vec\map($words, fn ($p) => ucfirst(Str\lowercase($p)));

    return Str\join($studlyWords, '');
}

/**
 * @no-named-arguments
 */
function camel(string ...$pieces): string
{
    return lcfirst(studly(...$pieces));
}

/**
 * Debugging helper, dumps TreeNode object.
 *
 * @return never
 */
function da(Compiler\Llk\TreeNode $ast): void
{
    echo (new Compiler\Visitor\Dump())->visit($ast);

    exit(1);
}
