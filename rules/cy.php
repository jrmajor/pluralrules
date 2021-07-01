<?php

use function Major\PluralRules\Operands\n;

return [
    'zero' => fn ($n) => n($n) == 0,
    'one' => fn ($n) => n($n) == 1,
    'two' => fn ($n) => n($n) == 2,
    'few' => fn ($n) => n($n) == 3,
    'many' => fn ($n) => n($n) == 6,
];
