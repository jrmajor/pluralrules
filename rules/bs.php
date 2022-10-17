<?php

use function Major\PluralRules\Operands\{f, i, v};
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'one' => fn ($n) => v($n) == 0 && mod(i($n), 10) == 1 && mod(i($n), 100) != 11 || mod(f($n), 10) == 1 && mod(f($n), 100) != 11,
    'few' => fn ($n) => v($n) == 0 && in_range(mod(i($n), 10), 2, 4) && ! in_range(mod(i($n), 100), 12, 14) || in_range(mod(f($n), 10), 2, 4) && ! in_range(mod(f($n), 100), 12, 14),
];
