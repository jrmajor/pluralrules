<?php

use function Major\PluralRules\Operands\{i, v};

return [
    'one' => fn ($n) => v($n) == 0 && i($n) % 10 == 1,
    'two' => fn ($n) => v($n) == 0 && i($n) % 10 == 2,
    'few' => fn ($n) => v($n) == 0 && in_array(i($n) % 100, [0, 20, 40, 60, 80]),
    'many' => fn ($n) => v($n) != 0,
];
