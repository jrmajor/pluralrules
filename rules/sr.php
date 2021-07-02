<?php

use function Major\PluralRules\Operands\{f, i, in_range, v};

return [
    'one' => fn ($n) => (v($n) == 0) && (i($n) % 10 == 1) && ! (i($n) % 100 == 11) || (f($n) % 10 == 1) && ! (f($n) % 100 == 11),
    'few' => fn ($n) => (v($n) == 0) && (in_range(i($n) % 10, 2, 4)) && ! (in_range(i($n) % 100, 12, 14)) || (in_range(f($n) % 10, 2, 4)) && ! (in_range(f($n) % 100, 12, 14)),
];
