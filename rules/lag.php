<?php

use function Major\PluralRules\Operands\{i, n};

return [
    'zero' => fn ($n) => n($n) == 0,
    'one' => fn ($n) => (i($n) == 0 || i($n) == 1) && n($n) != 0,
];
