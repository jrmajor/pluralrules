<?php

use function Major\PluralRules\Operands\n;
use function Major\PluralRules\Operators\in_range;

return [
    'one' => fn ($n) => n($n) == 1,
    'two' => fn ($n) => n($n) == 2,
    'few' => fn ($n) => in_range(n($n), 3, 6),
    'many' => fn ($n) => in_range(n($n), 7, 10),
];
