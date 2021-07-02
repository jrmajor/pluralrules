<?php

use function Major\PluralRules\Operands\{i, v};

return [
    'one' => fn ($n) => (i($n) == 1) && (v($n) == 0),
];
