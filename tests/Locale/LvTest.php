<?php

use Major\PluralRules\PluralRules;

test('zero', function ($num) {
    $category = PluralRules::select('lv', $num);
    expect($category)->toBe('zero');
})->with([
    0,
    10,
    20,
    30,
    40,
    50,
    60,
    100,
    1000,
    10000,
    100000,
    1000000,
    0.0,
    10.0,
    11.0,
    12.0,
    13.0,
    14.0,
    15.0,
    16.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);

test('one', function ($num) {
    $category = PluralRules::select('lv', $num);
    expect($category)->toBe('one');
})->with([
    1,
    21,
    31,
    41,
    51,
    61,
    71,
    81,
    101,
    1001,
    0.1,
    1.0,
    1.1,
    2.1,
    3.1,
    4.1,
    5.1,
    6.1,
    7.1,
    10.1,
    100.1,
    1000.1,
]);

test('other', function ($num) {
    $category = PluralRules::select('lv', $num);
    expect($category)->toBe('other');
})->with([
    2,
    9,
    22,
    29,
    102,
    1002,
    0.2,
    0.9,
    1.2,
    1.9,
    10.2,
    100.2,
    1000.2,
]);
