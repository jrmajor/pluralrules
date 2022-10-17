<?php

use function Major\PluralRules\Operands\{f, i, n};

return [
    'one' => fn ($n) => (n($n) == 0 || n($n) == 1) || i($n) == 0 && f($n) == 1,
];
