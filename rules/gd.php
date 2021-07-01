<?php

use function Major\PluralRules\Operands\n;

return [
    'one' => fn ($n) => in_array(n($n), [1, 11]),
    'two' => fn ($n) => in_array(n($n), [2, 12]),
    'few' => fn ($n) => in_array(n($n), [3, 4, 5, 6, 7, 8, 9, 10, 13, 14, 15, 16, 17, 18, 19]),
];
