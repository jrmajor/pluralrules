<?php

use function Major\PluralRules\Operands\{in_range, n};

return [
    'one' => fn ($n) => (n($n) == 1),
    'few' => fn ($n) => (n($n) == 0) || (in_range(n($n) % 100, 2, 10)),
    'many' => fn ($n) => (in_range(n($n) % 100, 11, 19)),
];
