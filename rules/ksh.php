<?php

use function Major\PluralRules\Operands\n;

return [
    'zero' => fn ($n) => (n($n) == 0),
    'one' => fn ($n) => (n($n) == 1),
];
