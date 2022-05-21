<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('gd', $num);
    expect($category)->toBe('one');
})->with([
    1,
    11,
    1.0,
    11.0,
    '1.00',
    '11.00',
    '1.000',
    '11.000',
    '1.0000',
]);

test('two', function ($num) {
    $category = PluralRules::select('gd', $num);
    expect($category)->toBe('two');
})->with([
    2,
    12,
    2.0,
    12.0,
    '2.00',
    '12.00',
    '2.000',
    '12.000',
    '2.0000',
]);

test('few', function ($num) {
    $category = PluralRules::select('gd', $num);
    expect($category)->toBe('few');
})->with([
    3,
    10,
    13,
    19,
    3.0,
    4.0,
    5.0,
    6.0,
    7.0,
    8.0,
    9.0,
    10.0,
    13.0,
    14.0,
    15.0,
    16.0,
    17.0,
    18.0,
    19.0,
    '3.00',
]);

test('other', function ($num) {
    $category = PluralRules::select('gd', $num);
    expect($category)->toBe('other');
})->with([
    0,
    20,
    34,
    100,
    1000,
    10000,
    100000,
    1000000,
    0.0,
    0.9,
    1.1,
    1.6,
    10.1,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
