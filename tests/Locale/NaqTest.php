<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('naq', $num);
    expect($category)->toBe('one');
})->with([
    1,
    1.0,
    '1.00',
    '1.000',
    '1.0000',
]);

test('two', function ($num) {
    $category = PluralRules::select('naq', $num);
    expect($category)->toBe('two');
})->with([
    2,
    2.0,
    '2.00',
    '2.000',
    '2.0000',
]);

test('other', function ($num) {
    $category = PluralRules::select('naq', $num);
    expect($category)->toBe('other');
})->with([
    3,
    17,
    100,
    1000,
    10000,
    100000,
    1000000,
    0.0,
    0.9,
    1.1,
    1.6,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
