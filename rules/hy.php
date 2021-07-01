<?php

use function Major\PluralRules\Operands\i;

return [
    'one' => fn ($n) => in_array(i($n), [0, 1]),
];
