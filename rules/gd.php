<?php

use function Major\PluralRules\Operands\n;
use function Major\PluralRules\Operators\in_range;

return [
    'one' => fn ($n) => (n($n) == 1 || n($n) == 11),
    'two' => fn ($n) => (n($n) == 2 || n($n) == 12),
    'few' => fn ($n) => (in_range(n($n), 3, 10) || in_range(n($n), 13, 19)),
];
