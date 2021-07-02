<?php

use function Major\PluralRules\Operands\{i, in_range, v};

return [
    'one' => fn ($n) => (i($n) == 1) && (v($n) == 0),
    'few' => fn ($n) => (in_range(i($n), 2, 4)) && (v($n) == 0),
    'many' => fn ($n) => ! (v($n) == 0),
];
