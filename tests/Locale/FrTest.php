<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('fr', $num);
    expect($category)->toBe('one');
})->with([
    1,
    0.0,
    1.5,
]);

test('many', function ($num) {
    $category = PluralRules::select('fr', $num);
    expect($category)->toBe('many');
})->with([
    1000000,
]);

test('other', function ($num) {
    $category = PluralRules::select('fr', $num);
    expect($category)->toBe('other');
})->with([
    2,
    17,
    100,
    1000,
    10000,
    100000,
    2.0,
    3.5,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
