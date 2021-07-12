<?php

use function Major\PluralRules\Operands\{i, v};
use function Major\PluralRules\Operators\in_range;

return [
    'one' => fn ($n) => (i($n) == 1) && (v($n) == 0),
    'few' => fn ($n) => (in_range(i($n), 2, 4)) && (v($n) == 0),
    'many' => fn ($n) => ! (v($n) == 0),
];
