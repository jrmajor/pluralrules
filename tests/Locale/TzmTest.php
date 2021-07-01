<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('tzm', $num);
    expect($category)->toBe('one');
})->with([
    1,
    11,
    24,
    0.0,
    1.0,
    11.0,
    12.0,
    13.0,
    14.0,
    15.0,
    16.0,
    17.0,
    18.0,
    19.0,
    20.0,
    21.0,
    22.0,
    23.0,
    24.0,
]);

test('other', function ($num) {
    $category = PluralRules::select('tzm', $num);
    expect($category)->toBe('other');
})->with([
    2,
    10,
    100,
    106,
    1000,
    10000,
    100000,
    1000000,
    0.1,
    0.9,
    1.1,
    1.7,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
