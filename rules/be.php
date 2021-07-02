<?php

use function Major\PluralRules\Operands\{in_range, n};

return [
    'one' => fn ($n) => (n($n) % 10 == 1) && ! (n($n) % 100 == 11),
    'few' => fn ($n) => (in_range(n($n) % 10, 2, 4)) && ! (in_range(n($n) % 100, 12, 14)),
    'many' => fn ($n) => (n($n) % 10 == 0) || (in_range(n($n) % 10, 5, 9)) || (in_range(n($n) % 100, 11, 14)),
];
