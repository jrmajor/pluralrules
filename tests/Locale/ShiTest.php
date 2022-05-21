<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('shi', $num);
    expect($category)->toBe('one');
})->with([
    0,
    1,
    0.0,
    1.0,
    '0.00',
    0.04,
]);

test('few', function ($num) {
    $category = PluralRules::select('shi', $num);
    expect($category)->toBe('few');
})->with([
    2,
    10,
    2.0,
    3.0,
    4.0,
    5.0,
    6.0,
    7.0,
    8.0,
    9.0,
    10.0,
    '2.00',
    '3.00',
    '4.00',
    '5.00',
    '6.00',
    '7.00',
    '8.00',
]);

test('other', function ($num) {
    $category = PluralRules::select('shi', $num);
    expect($category)->toBe('other');
})->with([
    11,
    26,
    100,
    1000,
    10000,
    100000,
    1000000,
    1.1,
    1.9,
    2.1,
    2.7,
    10.1,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
