<?php

use Major\PluralRules\PluralRules;

test('other', function ($num) {
    $category = PluralRules::select('in', $num);
    expect($category)->toBe('other');
})->with([
    15,
    100,
    1000,
    10000,
    100000,
    1000000,
    0.0,
    1.5,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
