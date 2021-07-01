<?php

use function Major\PluralRules\Operands\{i, n};

return [
    'one' => fn ($n) => i($n) == 0 || n($n) == 1,
    'few' => fn ($n) => in_array(n($n), [2, 3, 4, 5, 6, 7, 8, 9, 10]),
];
