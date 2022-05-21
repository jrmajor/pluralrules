<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('dsb', $num);
    expect($category)->toBe('one');
})->with([
    1,
    101,
    201,
    301,
    401,
    501,
    601,
    701,
    1001,
    0.1,
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

test('two', function ($num) {
    $category = PluralRules::select('dsb', $num);
    expect($category)->toBe('two');
})->with([
    2,
    102,
    202,
    302,
    402,
    502,
    602,
    702,
    1002,
    0.2,
    1.2,
    2.2,
    3.2,
    4.2,
    5.2,
    6.2,
    7.2,
    10.2,
    100.2,
    1000.2,
]);

test('few', function ($num) {
    $category = PluralRules::select('dsb', $num);
    expect($category)->toBe('few');
})->with([
    3,
    4,
    103,
    104,
    203,
    204,
    303,
    304,
    403,
    404,
    503,
    504,
    603,
    604,
    703,
    704,
    1003,
    0.3,
    0.4,
    1.3,
    1.4,
    2.3,
    2.4,
    3.3,
    3.4,
    4.3,
    4.4,
    5.3,
    5.4,
    6.3,
    6.4,
    7.3,
    7.4,
    10.3,
    100.3,
    1000.3,
]);

test('other', function ($num) {
    $category = PluralRules::select('dsb', $num);
    expect($category)->toBe('other');
})->with([
    0,
    5,
    19,
    100,
    1000,
    10000,
    100000,
    1000000,
    0.0,
    0.5,
    1.0,
    1.5,
    2.0,
    2.5,
    2.7,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
