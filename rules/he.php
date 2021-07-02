<?php

use function Major\PluralRules\Operands\{i, in_range, n, v};

return [
    'one' => fn ($n) => (i($n) == 1) && (v($n) == 0),
    'two' => fn ($n) => (i($n) == 2) && (v($n) == 0),
    'many' => fn ($n) => (v($n) == 0) && ! (in_range(n($n), 0, 10)) && (n($n) % 10 == 0),
];
