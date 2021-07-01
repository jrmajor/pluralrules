<?php

use function Major\PluralRules\Operands\{i, n};

return [
    'zero' => fn ($n) => n($n) == 0,
    'one' => fn ($n) => in_array(i($n), [0, 1]) && n($n) != 0,
];
