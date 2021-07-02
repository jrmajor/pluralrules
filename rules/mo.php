<?php

use function Major\PluralRules\Operands\{i, in_range, mod, n, v};

return [
    'one' => fn ($n) => (i($n) == 1) && (v($n) == 0),
    'few' => fn ($n) => ! (v($n) == 0) || (n($n) == 0) || (in_range(mod(n($n), 100), 2, 19)),
];
