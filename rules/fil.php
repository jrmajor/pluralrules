<?php

use function Major\PluralRules\Operands\{f, i, v};

return [
    'one' => fn ($n) => (v($n) == 0) && (i($n) == 1 || i($n) == 2 || i($n) == 3) || (v($n) == 0) && ! (i($n) % 10 == 4 || i($n) % 10 == 6 || i($n) % 10 == 9) || ! (v($n) == 0) && ! (f($n) % 10 == 4 || f($n) % 10 == 6 || f($n) % 10 == 9),
];
