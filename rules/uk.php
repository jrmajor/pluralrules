<?php

use function Major\PluralRules\Operands\{i, in_range, v};

return [
    'one' => fn ($n) => (v($n) == 0) && (i($n) % 10 == 1) && ! (i($n) % 100 == 11),
    'few' => fn ($n) => (v($n) == 0) && (in_range(i($n) % 10, 2, 4)) && ! (in_range(i($n) % 100, 12, 14)),
    'many' => fn ($n) => (v($n) == 0) && (i($n) % 10 == 0) || (v($n) == 0) && (in_range(i($n) % 10, 5, 9)) || (v($n) == 0) && (in_range(i($n) % 100, 11, 14)),
];
