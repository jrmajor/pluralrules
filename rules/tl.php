<?php

use function Major\PluralRules\Operands\{f, i, v};
use function Major\PluralRules\Operators\mod;

return [
    'one' => fn ($n) => v($n) == 0 && (i($n) == 1 || i($n) == 2 || i($n) == 3) || v($n) == 0 && ! (mod(i($n), 10) == 4 || mod(i($n), 10) == 6 || mod(i($n), 10) == 9) || v($n) != 0 && ! (mod(f($n), 10) == 4 || mod(f($n), 10) == 6 || mod(f($n), 10) == 9),
];
