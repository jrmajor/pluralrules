<?php

use function Major\PluralRules\Operands\{f, i, mod, v};

return [
    'one' => fn ($n) => (v($n) == 0) && (mod(i($n), 10) == 1) && ! (mod(i($n), 100) == 11) || (mod(f($n), 10) == 1) && ! (mod(f($n), 100) == 11),
];
