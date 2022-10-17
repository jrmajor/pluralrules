<?php

use function Major\PluralRules\Operands\{i, n};
use function Major\PluralRules\Operators\in_range;

return [
    'one' => fn ($n) => i($n) == 0 || n($n) == 1,
    'few' => fn ($n) => in_range(n($n), 2, 10),
];
