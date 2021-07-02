<?php

use function Major\PluralRules\Operands\i;

return [
    'one' => fn ($n) => (i($n) == 0 || i($n) == 1),
];
