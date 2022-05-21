<?php

use Major\PluralRules\PluralRules;

test('one', function ($num) {
    $category = PluralRules::select('gu', $num);
    expect($category)->toBe('one');
})->with([
    0,
    1,
    0.0,
    1.0,
    '0.00',
    0.04,
]);

test('other', function ($num) {
    $category = PluralRules::select('gu', $num);
    expect($category)->toBe('other');
})->with([
    2,
    17,
    100,
    1000,
    10000,
    100000,
    1000000,
    1.1,
    2.6,
    10.0,
    100.0,
    1000.0,
    10000.0,
    100000.0,
    1000000.0,
]);
