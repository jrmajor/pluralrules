<?php

use function Major\PluralRules\Operands\{f, i, v};

return [
    'one' => fn ($n) => v($n) == 0 && i($n) % 10 == 1 && i($n) % 100 != 11 || f($n) % 10 == 1 && f($n) % 100 != 11,
    'few' => fn ($n) => v($n) == 0 && in_array(i($n) % 10, [2, 3, 4]) && ! in_array(i($n) % 100, [12, 13, 14]) || in_array(f($n) % 10, [2, 3, 4]) && ! in_array(f($n) % 100, [12, 13, 14]),
];
