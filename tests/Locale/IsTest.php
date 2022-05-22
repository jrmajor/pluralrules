<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class IsTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num)
    {
        $category = PluralRules::select('is', $num);
        $this->assertSame('one', $category);
    }

    public function provideOneCases()
    {
        return [
            [1],
            [21],
            [31],
            [41],
            [51],
            [61],
            [71],
            [81],
            [101],
            [1001],
            [0.1],
            [1.6],
            [10.1],
            [100.1],
            [1000.1],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num)
    {
        $category = PluralRules::select('is', $num);
        $this->assertSame('other', $category);
    }

    public function provideOtherCases()
    {
        return [
            [0],
            [2],
            [16],
            [100],
            [1000],
            [10000],
            [100000],
            [1000000],
            [0.0],
            [2.0],
            [3.0],
            [4.0],
            [5.0],
            [6.0],
            [7.0],
            [8.0],
            [10.0],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }
}
