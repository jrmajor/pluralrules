<?php

use function Major\PluralRules\Operands\{i, v};

return [
    'one' => fn ($n) => i($n) == 1 && v($n) == 0,
    'few' => fn ($n) => in_array(i($n), [2, 3, 4]) && v($n) == 0,
    'many' => fn ($n) => v($n) != 0,
];
