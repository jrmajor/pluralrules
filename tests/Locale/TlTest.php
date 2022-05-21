<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('tl', $num);
    expect($category)->toBe('one');
})->with([
    0,
    3,
    5,
    7,
    8,
    10,
    13,
    15,
    17,
    18,
    20,
    21,
    100,
    1000,
    10000,
    100000,
    1000000,
    0.0,
    0.3,
    0.5,
    0.7,
    0.8,
    1.0,
    1.3,
    1.5,
    1.7,
    1.8,
    2.0,
    2.1,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);

test('other', function ($num) {
    $category = PluralRules::select('tl', $num);
    expect($category)->toBe('other');
})->with([
    4,
    6,
    9,
    14,
    16,
    19,
    24,
    26,
    104,
    1004,
    0.4,
    0.6,
    0.9,
    1.4,
    1.6,
    1.9,
    2.4,
    2.6,
    10.4,
    100.4,
    1000.4,
]);
