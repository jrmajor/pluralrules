<?php

use function Major\PluralRules\Operands\{f, n, v};

return [
    'zero' => fn ($n) => n($n) % 10 == 0 || in_array(n($n) % 100, [11, 12, 13, 14, 15, 16, 17, 18, 19]) || v($n) == 2 && in_array(f($n) % 100, [11, 12, 13, 14, 15, 16, 17, 18, 19]),
    'one' => fn ($n) => n($n) % 10 == 1 && n($n) % 100 != 11 || v($n) == 2 && f($n) % 10 == 1 && f($n) % 100 != 11 || v($n) != 2 && f($n) % 10 == 1,
];
