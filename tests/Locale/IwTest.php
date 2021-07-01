<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('iw', $num);
    expect($category)->toBe('one');
})->with([
    1,
]);

test('two', function ($num) {
    $category = PluralRules::select('iw', $num);
    expect($category)->toBe('two');
})->with([
    2,
]);

test('many', function ($num) {
    $category = PluralRules::select('iw', $num);
    expect($category)->toBe('many');
})->with([
    20,
    30,
    40,
    50,
    60,
    70,
    80,
    90,
    100,
    1000,
    10000,
    100000,
    1000000,
]);

test('other', function ($num) {
    $category = PluralRules::select('iw', $num);
    expect($category)->toBe('other');
})->with([
    3,
    17,
    101,
    1001,
    0.0,
    1.5,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
