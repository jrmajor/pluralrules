<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('br', $num);
    expect($category)->toBe('one');
})->with([
    1,
    21,
    31,
    41,
    51,
    61,
    81,
    101,
    1001,
    1.0,
    21.0,
    31.0,
    41.0,
    51.0,
    61.0,
    81.0,
    101.0,
    1001.0,
]);

test('two', function ($num) {
    $category = PluralRules::select('br', $num);
    expect($category)->toBe('two');
})->with([
    2,
    22,
    32,
    42,
    52,
    62,
    82,
    102,
    1002,
    2.0,
    22.0,
    32.0,
    42.0,
    52.0,
    62.0,
    82.0,
    102.0,
    1002.0,
]);

test('few', function ($num) {
    $category = PluralRules::select('br', $num);
    expect($category)->toBe('few');
})->with([
    3,
    4,
    9,
    23,
    24,
    29,
    33,
    34,
    39,
    43,
    44,
    49,
    103,
    1003,
    3.0,
    4.0,
    9.0,
    23.0,
    24.0,
    29.0,
    33.0,
    34.0,
    103.0,
    1003.0,
]);

test('many', function ($num) {
    $category = PluralRules::select('br', $num);
    expect($category)->toBe('many');
})->with([
    1000000,
    1000000.0,
    '1000000.00',
    '1000000.000',
    '1000000.0000',
]);

test('other', function ($num) {
    $category = PluralRules::select('br', $num);
    expect($category)->toBe('other');
})->with([
    5,
    8,
    10,
    20,
    100,
    1000,
    10000,
    100000,
    0.0,
    0.9,
    1.1,
    1.6,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
]);
