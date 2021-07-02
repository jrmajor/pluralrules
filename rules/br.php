<?php

use function Major\PluralRules\Operands\{in_range, n};

return [
    'one' => fn ($n) => (n($n) % 10 == 1) && ! (n($n) % 100 == 11 || n($n) % 100 == 71 || n($n) % 100 == 91),
    'two' => fn ($n) => (n($n) % 10 == 2) && ! (n($n) % 100 == 12 || n($n) % 100 == 72 || n($n) % 100 == 92),
    'few' => fn ($n) => (in_range(n($n) % 10, 3, 4) || n($n) % 10 == 9) && ! (in_range(n($n) % 100, 90, 99)),
    'many' => fn ($n) => ! (n($n) == 0) && (n($n) % 1000000 == 0),
];
