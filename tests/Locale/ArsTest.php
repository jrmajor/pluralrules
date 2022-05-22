<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class ArsTest extends TestCase
{
    /**
     * @dataProvider provideZeroCases
     */
    public function testZero(int|float|string $num)
    {
        $category = PluralRules::select('ars', $num);
        $this->assertSame('zero', $category);
    }

    public function provideZeroCases()
    {
        return [
            [0],
            [0.0],
            ['0.00'],
            ['0.000'],
            ['0.0000'],
        ];
    }

    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num)
    {
        $category = PluralRules::select('ars', $num);
        $this->assertSame('one', $category);
    }

    public function provideOneCases()
    {
        return [
            [1],
            [1.0],
            ['1.00'],
            ['1.000'],
            ['1.0000'],
        ];
    }

    /**
     * @dataProvider provideTwoCases
     */
    public function testTwo(int|float|string $num)
    {
        $category = PluralRules::select('ars', $num);
        $this->assertSame('two', $category);
    }

    public function provideTwoCases()
    {
        return [
            [2],
            [2.0],
            ['2.00'],
            ['2.000'],
            ['2.0000'],
        ];
    }

    /**
     * @dataProvider provideFewCases
     */
    public function testFew(int|float|string $num)
    {
        $category = PluralRules::select('ars', $num);
        $this->assertSame('few', $category);
    }

    public function provideFewCases()
    {
        return [
            [3],
            [10],
            [103],
            [110],
            [1003],
            [3.0],
            [4.0],
            [5.0],
            [6.0],
            [7.0],
            [8.0],
            [9.0],
            [10.0],
            [103.0],
            [1003.0],
        ];
    }

    /**
     * @dataProvider provideManyCases
     */
    public function testMany(int|float|string $num)
    {
        $category = PluralRules::select('ars', $num);
        $this->assertSame('many', $category);
    }

    public function provideManyCases()
    {
        return [
            [11],
            [26],
            [111],
            [1011],
            [11.0],
            [12.0],
            [13.0],
            [14.0],
            [15.0],
            [16.0],
            [17.0],
            [18.0],
            [111.0],
            [1011.0],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num)
    {
        $category = PluralRules::select('ars', $num);
        $this->assertSame('other', $category);
    }

    public function provideOtherCases()
    {
        return [
            [100],
            [102],
            [200],
            [202],
            [300],
            [302],
            [400],
            [402],
            [500],
            [502],
            [600],
            [1000],
            [10000],
            [100000],
            [1000000],
            [0.1],
            [0.9],
            [1.1],
            [1.7],
            [10.1],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }
}
