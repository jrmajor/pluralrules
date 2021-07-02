<?php

use function Major\PluralRules\Operands\{i, n};

return [
    'one' => fn ($n) => (i($n) == 0) || (n($n) == 1),
];
