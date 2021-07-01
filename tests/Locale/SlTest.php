<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('sl', $num);
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
]);

test('two', function ($num) {
    $category = PluralRules::select('sl', $num);
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
]);

test('few', function ($num) {
    $category = PluralRules::select('sl', $num);
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
    $category = PluralRules::select('sl', $num);
    expect($category)->toBe('other');
})->with([
    5,
    19,
    100,
    1000,
    10000,
    100000,
    1000000,
]);
