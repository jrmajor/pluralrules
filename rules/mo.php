<?php

use function Major\PluralRules\Operands\{i, n, v};
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'one' => fn ($n) => (i($n) == 1) && (v($n) == 0),
    'few' => fn ($n) => ! (v($n) == 0) || (n($n) == 0) || (in_range(mod(n($n), 100), 2, 19)),
];
