<?php

use function Major\PluralRules\Operands\n;
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'one' => fn ($n) => (mod(n($n), 10) == 1) && ! (mod(n($n), 100) == 11),
    'few' => fn ($n) => (in_range(mod(n($n), 10), 2, 4)) && ! (in_range(mod(n($n), 100), 12, 14)),
    'many' => fn ($n) => (mod(n($n), 10) == 0) || (in_range(mod(n($n), 10), 5, 9)) || (in_range(mod(n($n), 100), 11, 14)),
];
