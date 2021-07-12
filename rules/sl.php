<?php

use function Major\PluralRules\Operands\{i, v};
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'one' => fn ($n) => (v($n) == 0) && (mod(i($n), 100) == 1),
    'two' => fn ($n) => (v($n) == 0) && (mod(i($n), 100) == 2),
    'few' => fn ($n) => (v($n) == 0) && (in_range(mod(i($n), 100), 3, 4)) || ! (v($n) == 0),
];
