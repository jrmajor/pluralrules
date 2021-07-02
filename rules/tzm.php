<?php

use function Major\PluralRules\Operands\{in_range, n};

return [
    'one' => fn ($n) => (in_range(n($n), 0, 1)) || (in_range(n($n), 11, 99)),
];
