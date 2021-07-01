<?php

use function Major\PluralRules\Operands\{i, v};

return [
    'one' => fn ($n) => i($n) == 1 && v($n) == 0,
    'few' => fn ($n) => v($n) == 0 && in_array(i($n) % 10, [2, 3, 4]) && ! in_array(i($n) % 100, [12, 13, 14]),
    'many' => fn ($n) => v($n) == 0 && i($n) != 1 && in_array(i($n) % 10, [0, 1]) || v($n) == 0 && in_array(i($n) % 10, [5, 6, 7, 8, 9]) || v($n) == 0 && in_array(i($n) % 100, [12, 13, 14]),
];
