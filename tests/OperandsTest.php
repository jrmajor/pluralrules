<?php

use function Major\PluralRules\Operands\{f, i, n, t, v, w};

it('can compute operands', function ($source, $n, $i, $v, $w, $f, $t) {
    expect(n($source))->toBe($n);
    expect(i($source))->toBe($i);
    expect(v($source))->toBe($v);
    expect(w($source))->toBe($w);
    expect(f($source))->toBe($f);
    expect(t($source))->toBe($t);
})->with([
    ['1', 1.0, 1, 0, 0, 0, 0],
    ['1.0', 1.0, 1, 1, 0, 0, 0],
    ['1.00', 1.0, 1, 2, 0, 0, 0],
    ['1.3', 1.3, 1, 1, 1, 3, 3],
    ['1.30', 1.3, 1, 2, 1, 30, 3],
    ['1.03', 1.03, 1, 2, 2, 3, 3],
    ['1.230', 1.23, 1, 3, 2, 230, 23],
    ['1200000', 1200000.0, 1200000, 0, 0, 0, 0],
    ['1200.50', 1200.5, 1200, 2, 1, 50, 5],
]);
