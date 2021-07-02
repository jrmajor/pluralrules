<?php

use function Major\PluralRules\Operands\{i, in_range, mod, v};

return [
    'one' => fn ($n) => (i($n) == 1) && (v($n) == 0),
    'few' => fn ($n) => (v($n) == 0) && (in_range(mod(i($n), 10), 2, 4)) && ! (in_range(mod(i($n), 100), 12, 14)),
    'many' => fn ($n) => (v($n) == 0) && ! (i($n) == 1) && (in_range(mod(i($n), 10), 0, 1)) || (v($n) == 0) && (in_range(mod(i($n), 10), 5, 9)) || (v($n) == 0) && (in_range(mod(i($n), 100), 12, 14)),
];
