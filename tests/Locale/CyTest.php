<?php

use Major\PluralRules\PluralRules;

test('zero', function ($num) {
    $category = PluralRules::select('cy', $num);
    expect($category)->toBe('zero');
})->with([
    0,
    0.0,
    '0.00',
    '0.000',
    '0.0000',
]);

test('one', function ($num) {
    $category = PluralRules::select('cy', $num);
    expect($category)->toBe('one');
})->with([
    1,
    1.0,
    '1.00',
    '1.000',
    '1.0000',
]);

test('two', function ($num) {
    $category = PluralRules::select('cy', $num);
    expect($category)->toBe('two');
})->with([
    2,
    2.0,
    '2.00',
    '2.000',
    '2.0000',
]);

test('few', function ($num) {
    $category = PluralRules::select('cy', $num);
    expect($category)->toBe('few');
})->with([
    3,
    3.0,
    '3.00',
    '3.000',
    '3.0000',
]);

test('many', function ($num) {
    $category = PluralRules::select('cy', $num);
    expect($category)->toBe('many');
})->with([
    6,
    6.0,
    '6.00',
    '6.000',
    '6.0000',
]);

test('other', function ($num) {
    $category = PluralRules::select('cy', $num);
    expect($category)->toBe('other');
})->with([
    4,
    5,
    7,
    20,
    100,
    1000,
    10000,
    100000,
    1000000,
    0.1,
    0.9,
    1.1,
    1.7,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
