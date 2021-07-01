<?php

use function Major\PluralRules\Operands\{i, n, t};

return [
    'one' => fn ($n) => n($n) == 1 || t($n) != 0 && in_array(i($n), [0, 1]),
];
