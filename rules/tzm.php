<?php

use function Major\PluralRules\Operands\n;
use function Major\PluralRules\Operators\in_range;

return [
    'one' => fn ($n) => in_range(n($n), 0, 1) || in_range(n($n), 11, 99),
];
