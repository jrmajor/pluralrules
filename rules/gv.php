<?php

use function Major\PluralRules\Operands\{i, v};

return [
    'one' => fn ($n) => (v($n) == 0) && (i($n) % 10 == 1),
    'two' => fn ($n) => (v($n) == 0) && (i($n) % 10 == 2),
    'few' => fn ($n) => (v($n) == 0) && (i($n) % 100 == 0 || i($n) % 100 == 20 || i($n) % 100 == 40 || i($n) % 100 == 60 || i($n) % 100 == 80),
    'many' => fn ($n) => ! (v($n) == 0),
];
