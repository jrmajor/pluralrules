<?php

use function Major\PluralRules\Operands\n;

return [
    'one' => fn ($n) => n($n) == 1,
    'two' => fn ($n) => n($n) == 2,
];
