<?php

use function Major\PluralRules\Operands\{f, i, v};

return [
    'one' => fn ($n) => v($n) == 0 && i($n) % 100 == 1 || f($n) % 100 == 1,
    'two' => fn ($n) => v($n) == 0 && i($n) % 100 == 2 || f($n) % 100 == 2,
    'few' => fn ($n) => v($n) == 0 && in_array(i($n) % 100, [3, 4]) || in_array(f($n) % 100, [3, 4]),
];
