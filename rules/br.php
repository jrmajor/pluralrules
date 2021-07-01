<?php

use function Major\PluralRules\Operands\n;

return [
    'one' => fn ($n) => n($n) % 10 == 1 && ! in_array(n($n) % 100, [11, 71, 91]),
    'two' => fn ($n) => n($n) % 10 == 2 && ! in_array(n($n) % 100, [12, 72, 92]),
    'few' => fn ($n) => in_array(n($n) % 10, [3, 4, 9]) && ! in_array(n($n) % 100, [10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99]),
    'many' => fn ($n) => n($n) != 0 && n($n) % 1000000 == 0,
];
