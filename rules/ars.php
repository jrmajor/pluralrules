<?php

use function Major\PluralRules\Operands\n;
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'zero' => fn ($n) => (n($n) == 0),
    'one' => fn ($n) => (n($n) == 1),
    'two' => fn ($n) => (n($n) == 2),
    'few' => fn ($n) => (in_range(mod(n($n), 100), 3, 10)),
    'many' => fn ($n) => (in_range(mod(n($n), 100), 11, 99)),
];
