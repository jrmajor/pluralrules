<?php

use function Major\PluralRules\Operands\{i, n, t};

return [
    'one' => fn ($n) => (n($n) == 1) || ! (t($n) == 0) && (i($n) == 0 || i($n) == 1),
];
