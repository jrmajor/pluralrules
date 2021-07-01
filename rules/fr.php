<?php

use function Major\PluralRules\Operands\{e, i, v};

return [
    'one' => fn ($n) => in_array(i($n), [0, 1]),
    'many' => fn ($n) => e($n) == 0 && i($n) != 0 && i($n) % 1000000 == 0 && v($n) == 0 || ! in_array(e($n), [0, 1, 2, 3, 4, 5]),
];
