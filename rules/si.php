<?php

use function Major\PluralRules\Operands\{f, i, n};

return [
    'one' => fn ($n) => in_array(n($n), [0, 1]) || i($n) == 0 && f($n) == 1,
];
