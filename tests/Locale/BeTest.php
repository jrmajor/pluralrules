<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('be', $num);
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
    1.0,
    21.0,
    31.0,
    41.0,
    51.0,
    61.0,
    71.0,
    81.0,
    101.0,
    1001.0,
]);

test('few', function ($num) {
    $category = PluralRules::select('be', $num);
    expect($category)->toBe('few');
})->with([
    2,
    4,
    22,
    24,
    32,
    34,
    42,
    44,
    52,
    54,
    62,
    102,
    1002,
    2.0,
    3.0,
    4.0,
    22.0,
    23.0,
    24.0,
    32.0,
    33.0,
    102.0,
    1002.0,
]);

test('many', function ($num) {
    $category = PluralRules::select('be', $num);
    expect($category)->toBe('many');
})->with([
    5,
    19,
    100,
    1000,
    10000,
    100000,
    1000000,
    0.0,
    5.0,
    6.0,
    7.0,
    8.0,
    9.0,
    10.0,
    11.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);

test('other', function ($num) {
    $category = PluralRules::select('be', $num);
    expect($category)->toBe('other');
})->with([
    0.1,
    0.9,
    1.1,
    1.7,
    10.1,
    100.1,
    1000.1,
]);
