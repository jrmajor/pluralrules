<?php

use function Major\PluralRules\Operands\{i, n, v};

return [
    'one' => fn ($n) => i($n) == 1 && v($n) == 0,
    'two' => fn ($n) => i($n) == 2 && v($n) == 0,
    'many' => fn ($n) => v($n) == 0 && ! in_array(n($n), [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]) && n($n) % 10 == 0,
];
