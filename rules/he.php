<?php

use function Major\PluralRules\Operands\{i, n, v};
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'one' => fn ($n) => i($n) == 1 && v($n) == 0,
    'two' => fn ($n) => i($n) == 2 && v($n) == 0,
    'many' => fn ($n) => v($n) == 0 && ! in_range(n($n), 0, 10) && mod(n($n), 10) == 0,
];
