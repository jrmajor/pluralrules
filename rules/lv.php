<?php

use function Major\PluralRules\Operands\{f, in_range, n, v};

return [
    'zero' => fn ($n) => (n($n) % 10 == 0) || (in_range(n($n) % 100, 11, 19)) || (v($n) == 2) && (in_range(f($n) % 100, 11, 19)),
    'one' => fn ($n) => (n($n) % 10 == 1) && ! (n($n) % 100 == 11) || (v($n) == 2) && (f($n) % 10 == 1) && ! (f($n) % 100 == 11) || ! (v($n) == 2) && (f($n) % 10 == 1),
];
