<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('mt', $num);
    expect($category)->toBe('one');
})->with([
    1,
    1.0,
    '1.00',
    '1.000',
    '1.0000',
]);

test('few', function ($num) {
    $category = PluralRules::select('mt', $num);
    expect($category)->toBe('few');
})->with([
    0,
    2,
    10,
    102,
    107,
    1002,
    0.0,
    2.0,
    3.0,
    4.0,
    5.0,
    6.0,
    7.0,
    8.0,
    10.0,
    102.0,
    1002.0,
]);

test('many', function ($num) {
    $category = PluralRules::select('mt', $num);
    expect($category)->toBe('many');
})->with([
    11,
    19,
    111,
    117,
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
    $category = PluralRules::select('mt', $num);
    expect($category)->toBe('other');
})->with([
    20,
    35,
    100,
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
