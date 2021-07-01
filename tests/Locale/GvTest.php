<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('gv', $num);
    expect($category)->toBe('one');
})->with([
    1,
    11,
    21,
    31,
    41,
    51,
    61,
    71,
    101,
    1001,
]);

test('two', function ($num) {
    $category = PluralRules::select('gv', $num);
    expect($category)->toBe('two');
})->with([
    2,
    12,
    22,
    32,
    42,
    52,
    62,
    72,
    102,
    1002,
]);

test('few', function ($num) {
    $category = PluralRules::select('gv', $num);
    expect($category)->toBe('few');
})->with([
    20,
    40,
    60,
    80,
    100,
    120,
    140,
    1000,
    10000,
    100000,
    1000000,
]);

test('many', function ($num) {
    $category = PluralRules::select('gv', $num);
    expect($category)->toBe('many');
})->with([
    0.0,
    1.5,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);

test('other', function ($num) {
    $category = PluralRules::select('gv', $num);
    expect($category)->toBe('other');
})->with([
    3,
    10,
    13,
    19,
    23,
    103,
    1003,
]);
