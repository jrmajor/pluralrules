<?php

namespace Major\PluralRules\Dev\Helpers;

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

    $studlyWords = Vec\map($words, fn ($p) => Str\capitalize(Str\lowercase($p)));

    return Str\join($studlyWords, '');
}

/**
 * @no-named-arguments
 */
function camel(string ...$pieces): string
{
    return lcfirst(studly(...$pieces));
}
