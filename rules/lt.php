<?php

use function Major\PluralRules\Operands\{f, in_range, mod, n};

return [
    'one' => fn ($n) => (mod(n($n), 10) == 1) && ! (in_range(mod(n($n), 100), 11, 19)),
    'few' => fn ($n) => (in_range(mod(n($n), 10), 2, 9)) && ! (in_range(mod(n($n), 100), 11, 19)),
    'many' => fn ($n) => ! (f($n) == 0),
];
