<?php

use Major\PluralRules\PluralRules;

test('zero', function ($num) {
    $category = PluralRules::select('lag', $num);
    expect($category)->toBe('zero');
})->with([
    0,
    0.0,
    '0.00',
    '0.000',
    '0.0000',
]);

test('one', function ($num) {
    $category = PluralRules::select('lag', $num);
    expect($category)->toBe('one');
})->with([
    1,
    0.1,
    1.6,
]);

test('other', function ($num) {
    $category = PluralRules::select('lag', $num);
    expect($category)->toBe('other');
})->with([
    2,
    17,
    100,
    1000,
    10000,
    100000,
    1000000,
    2.0,
    3.5,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
