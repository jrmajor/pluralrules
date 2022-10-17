<?php

use function Major\PluralRules\Operands\n;

return [
    'one' => fn ($n) => n($n) == 1,
];
