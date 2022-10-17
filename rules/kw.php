<?php

use function Major\PluralRules\Operands\n;
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'zero' => fn ($n) => n($n) == 0,
    'one' => fn ($n) => n($n) == 1,
    'two' => fn ($n) => (mod(n($n), 100) == 2 || mod(n($n), 100) == 22 || mod(n($n), 100) == 42 || mod(n($n), 100) == 62 || mod(n($n), 100) == 82) || mod(n($n), 1000) == 0 && (in_range(mod(n($n), 100000), 1000, 20000) || mod(n($n), 100000) == 40000 || mod(n($n), 100000) == 60000 || mod(n($n), 100000) == 80000) || n($n) != 0 && mod(n($n), 1000000) == 100000,
    'few' => fn ($n) => (mod(n($n), 100) == 3 || mod(n($n), 100) == 23 || mod(n($n), 100) == 43 || mod(n($n), 100) == 63 || mod(n($n), 100) == 83),
    'many' => fn ($n) => n($n) != 1 && (mod(n($n), 100) == 1 || mod(n($n), 100) == 21 || mod(n($n), 100) == 41 || mod(n($n), 100) == 61 || mod(n($n), 100) == 81),
];
