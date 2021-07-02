<?php

use function Major\PluralRules\Operands\{i, t};

return [
    'one' => fn ($n) => (t($n) == 0) && (i($n) % 10 == 1) && ! (i($n) % 100 == 11) || ! (t($n) == 0),
];
