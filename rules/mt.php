<?php

use function Major\PluralRules\Operands\n;
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'one' => fn ($n) => (n($n) == 1),
    'few' => fn ($n) => (n($n) == 0) || (in_range(mod(n($n), 100), 2, 10)),
    'many' => fn ($n) => (in_range(mod(n($n), 100), 11, 19)),
];
