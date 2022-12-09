<?php

use function Major\PluralRules\Operands\{i, v};

return [
    'one' => fn ($n) => i($n) == 1 && v($n) == 0 || i($n) == 0 && v($n) != 0,
    'two' => fn ($n) => i($n) == 2 && v($n) == 0,
];
