<?php

use function Major\PluralRules\Operands\{f, in_range, n};

return [
    'one' => fn ($n) => (n($n) % 10 == 1) && ! (in_range(n($n) % 100, 11, 19)),
    'few' => fn ($n) => (in_range(n($n) % 10, 2, 9)) && ! (in_range(n($n) % 100, 11, 19)),
    'many' => fn ($n) => ! (f($n) == 0),
];
