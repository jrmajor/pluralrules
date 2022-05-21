<?php

use Major\PluralRules\PluralRules;

test('zero', function ($num) {
    $category = PluralRules::select('ar', $num);
    expect($category)->toBe('zero');
})->with([
    0,
    0.0,
    '0.00',
    '0.000',
    '0.0000',
]);

test('one', function ($num) {
    $category = PluralRules::select('ar', $num);
    expect($category)->toBe('one');
})->with([
    1,
    1.0,
    '1.00',
    '1.000',
    '1.0000',
]);

test('two', function ($num) {
    $category = PluralRules::select('ar', $num);
    expect($category)->toBe('two');
})->with([
    2,
    2.0,
    '2.00',
    '2.000',
    '2.0000',
]);

test('few', function ($num) {
    $category = PluralRules::select('ar', $num);
    expect($category)->toBe('few');
})->with([
    3,
    10,
    103,
    110,
    1003,
    3.0,
    4.0,
    5.0,
    6.0,
    7.0,
    8.0,
    9.0,
    10.0,
    103.0,
    1003.0,
]);

test('many', function ($num) {
    $category = PluralRules::select('ar', $num);
    expect($category)->toBe('many');
})->with([
    11,
    26,
    111,
    1011,
    11.0,
    12.0,
    13.0,
    14.0,
    15.0,
    16.0,
    17.0,
    18.0,
    111.0,
    1011.0,
]);

test('other', function ($num) {
    $category = PluralRules::select('ar', $num);
    expect($category)->toBe('other');
})->with([
    100,
    102,
    200,
    202,
    300,
    302,
    400,
    402,
    500,
    502,
    600,
    1000,
    10000,
    100000,
    1000000,
    0.1,
    0.9,
    1.1,
    1.7,
    10.1,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
