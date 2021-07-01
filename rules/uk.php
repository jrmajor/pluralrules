<?php

use function Major\PluralRules\Operands\{i, v};

return [
    'one' => fn ($n) => v($n) == 0 && i($n) % 10 == 1 && i($n) % 100 != 11,
    'few' => fn ($n) => v($n) == 0 && in_array(i($n) % 10, [2, 3, 4]) && ! in_array(i($n) % 100, [12, 13, 14]),
    'many' => fn ($n) => v($n) == 0 && i($n) % 10 == 0 || v($n) == 0 && in_array(i($n) % 10, [5, 6, 7, 8, 9]) || v($n) == 0 && in_array(i($n) % 100, [11, 12, 13, 14]),
];
