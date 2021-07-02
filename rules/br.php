<?php

use function Major\PluralRules\Operands\{in_range, mod, n};

return [
    'one' => fn ($n) => (mod(n($n), 10) == 1) && ! (mod(n($n), 100) == 11 || mod(n($n), 100) == 71 || mod(n($n), 100) == 91),
    'two' => fn ($n) => (mod(n($n), 10) == 2) && ! (mod(n($n), 100) == 12 || mod(n($n), 100) == 72 || mod(n($n), 100) == 92),
    'few' => fn ($n) => (in_range(mod(n($n), 10), 3, 4) || mod(n($n), 10) == 9) && ! (in_range(mod(n($n), 100), 10, 19) || in_range(mod(n($n), 100), 70, 79) || in_range(mod(n($n), 100), 90, 99)),
    'many' => fn ($n) => ! (n($n) == 0) && (mod(n($n), 1000000) == 0),
];
