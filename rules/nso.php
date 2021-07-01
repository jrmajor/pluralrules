<?php

use function Major\PluralRules\Operands\n;

return [
    'one' => fn ($n) => in_array(n($n), [0, 1]),
];
