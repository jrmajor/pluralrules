<?php

use function Major\PluralRules\Operands\i;
use function Major\PluralRules\Operators\in_range;

return [
    'one' => fn ($n) => in_range(i($n), 0, 1),
];
