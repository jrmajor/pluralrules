<?php

use function Major\PluralRules\Operands\{i, in_range};

return [
    'one' => fn ($n) => (in_range(i($n), 0, 1)),
];
