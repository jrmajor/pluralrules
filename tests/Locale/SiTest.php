<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('si', $num);
    expect($category)->toBe('one');
})->with([
    0,
    1,
    0.0,
    0.1,
    1.0,
    '0.00',
    0.01,
    '1.00',
    '0.000',
    0.001,
    '1.000',
    '0.0000',
    0.0001,
    '1.0000',
]);

test('other', function ($num) {
    $category = PluralRules::select('si', $num);
    expect($category)->toBe('other');
})->with([
    2,
    17,
    100,
    1000,
    10000,
    100000,
    1000000,
    0.2,
    0.9,
    1.1,
    1.8,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
