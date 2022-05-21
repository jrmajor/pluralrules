<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('gl', $num);
    expect($category)->toBe('one');
})->with([
    1,
]);

test('other', function ($num) {
    $category = PluralRules::select('gl', $num);
    expect($category)->toBe('other');
})->with([
    0,
    2,
    16,
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
