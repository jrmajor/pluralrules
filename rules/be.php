<?php

use function Major\PluralRules\Operands\n;

return [
    'one' => fn ($n) => n($n) % 10 == 1 && n($n) % 100 != 11,
    'few' => fn ($n) => in_array(n($n) % 10, [2, 3, 4]) && ! in_array(n($n) % 100, [12, 13, 14]),
    'many' => fn ($n) => n($n) % 10 == 0 || in_array(n($n) % 10, [5, 6, 7, 8, 9]) || in_array(n($n) % 100, [11, 12, 13, 14]),
];
