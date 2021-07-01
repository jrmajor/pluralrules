<?php

use function Major\PluralRules\Operands\n;

return [
    'one' => fn ($n) => n($n) == 1,
    'two' => fn ($n) => n($n) == 2,
    'few' => fn ($n) => in_array(n($n), [3, 4, 5, 6]),
    'many' => fn ($n) => in_array(n($n), [7, 8, 9, 10]),
];
