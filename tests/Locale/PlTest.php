<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('pl', $num);
    expect($category)->toBe('one');
})->with([
    1,
]);

test('few', function ($num) {
    $category = PluralRules::select('pl', $num);
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
]);

test('many', function ($num) {
    $category = PluralRules::select('pl', $num);
    expect($category)->toBe('many');
})->with([
    0,
    5,
    19,
    100,
    1000,
    10000,
    100000,
    1000000,
]);

test('other', function ($num) {
    $category = PluralRules::select('pl', $num);
    expect($category)->toBe('other');
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
