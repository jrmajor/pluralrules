<?php

use function Major\PluralRules\Operands\{i, v};
use function Major\PluralRules\Operators\mod;

return [
    'one' => fn ($n) => v($n) == 0 && mod(i($n), 10) == 1,
    'two' => fn ($n) => v($n) == 0 && mod(i($n), 10) == 2,
    'few' => fn ($n) => v($n) == 0 && (mod(i($n), 100) == 0 || mod(i($n), 100) == 20 || mod(i($n), 100) == 40 || mod(i($n), 100) == 60 || mod(i($n), 100) == 80),
    'many' => fn ($n) => v($n) != 0,
];
