<?php

use function Major\PluralRules\Operands\{i, in_range, mod, v};

return [
    'one' => fn ($n) => (v($n) == 0) && (mod(i($n), 100) == 1),
    'two' => fn ($n) => (v($n) == 0) && (mod(i($n), 100) == 2),
    'few' => fn ($n) => (v($n) == 0) && (in_range(mod(i($n), 100), 3, 4)) || ! (v($n) == 0),
];
