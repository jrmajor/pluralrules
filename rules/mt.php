<?php

use function Major\PluralRules\Operands\n;

return [
    'one' => fn ($n) => n($n) == 1,
    'few' => fn ($n) => n($n) == 0 || in_array(n($n) % 100, [2, 3, 4, 5, 6, 7, 8, 9, 10]),
    'many' => fn ($n) => in_array(n($n) % 100, [11, 12, 13, 14, 15, 16, 17, 18, 19]),
];
