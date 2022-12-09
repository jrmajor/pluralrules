<?php

use function Major\PluralRules\Operands\{i, t};
use function Major\PluralRules\Operators\mod;

return [
    'one' => fn ($n) => t($n) == 0 && mod(i($n), 10) == 1 && mod(i($n), 100) != 11 || mod(t($n), 10) == 1 && mod(t($n), 100) != 11,
];
