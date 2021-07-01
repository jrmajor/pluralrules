<?php

use function Major\PluralRules\Operands\{f, n};

return [
    'one' => fn ($n) => n($n) % 10 == 1 && ! in_array(n($n) % 100, [11, 12, 13, 14, 15, 16, 17, 18, 19]),
    'few' => fn ($n) => in_array(n($n) % 10, [2, 3, 4, 5, 6, 7, 8, 9]) && ! in_array(n($n) % 100, [11, 12, 13, 14, 15, 16, 17, 18, 19]),
    'many' => fn ($n) => f($n) != 0,
];
