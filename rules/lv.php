<?php

use function Major\PluralRules\Operands\{f, n, v};
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'zero' => fn ($n) => (mod(n($n), 10) == 0) || (in_range(mod(n($n), 100), 11, 19)) || (v($n) == 2) && (in_range(mod(f($n), 100), 11, 19)),
    'one' => fn ($n) => (mod(n($n), 10) == 1) && ! (mod(n($n), 100) == 11) || (v($n) == 2) && (mod(f($n), 10) == 1) && ! (mod(f($n), 100) == 11) || ! (v($n) == 2) && (mod(f($n), 10) == 1),
];
