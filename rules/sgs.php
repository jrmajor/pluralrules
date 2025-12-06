<?php

use function Major\PluralRules\Operands\{f, n};
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'one' => fn ($n) => mod(n($n), 10) == 1 && mod(n($n), 100) != 11,
    'two' => fn ($n) => n($n) == 2,
    'few' => fn ($n) => n($n) != 2 && in_range(mod(n($n), 10), 2, 9) && ! in_range(mod(n($n), 100), 11, 19),
    'many' => fn ($n) => f($n) != 0,
];
