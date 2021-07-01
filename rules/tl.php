<?php

use function Major\PluralRules\Operands\{f, i, v};

return [
    'one' => fn ($n) => v($n) == 0 && in_array(i($n), [1, 2, 3]) || v($n) == 0 && ! in_array(i($n) % 10, [4, 6, 9]) || v($n) != 0 && ! in_array(f($n) % 10, [4, 6, 9]),
];
