<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('hr', $num);
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

test('few', function ($num) {
    $category = PluralRules::select('hr', $num);
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
    0.2,
    0.4,
    1.2,
    1.4,
    2.2,
    2.4,
    3.2,
    3.4,
    4.2,
    4.4,
    5.2,
    10.2,
    100.2,
    1000.2,
]);

test('other', function ($num) {
    $category = PluralRules::select('hr', $num);
    expect($category)->toBe('other');
})->with([
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
