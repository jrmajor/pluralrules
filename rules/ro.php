<?php

use function Major\PluralRules\Operands\{i, n, v};

return [
    'one' => fn ($n) => i($n) == 1 && v($n) == 0,
    'few' => fn ($n) => v($n) != 0 || n($n) == 0 || in_array(n($n) % 100, [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]),
];
