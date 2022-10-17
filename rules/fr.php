<?php

use function Major\PluralRules\Operands\{e, i, v};
use function Major\PluralRules\Operators\{in_range, mod};

return [
    'one' => fn ($n) => (i($n) == 0 || i($n) == 1),
    'many' => fn ($n) => e($n) == 0 && i($n) != 0 && mod(i($n), 1000000) == 0 && v($n) == 0 || ! in_range(e($n), 0, 5),
];
