<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class PlTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num)
    {
        $category = PluralRules::select('pl', $num);
        $this->assertSame('one', $category);
    }

    public function provideOneCases()
    {
        return [
            [1],
        ];
    }

    /**
     * @dataProvider provideFewCases
     */
    public function testFew(int|float|string $num)
    {
        $category = PluralRules::select('pl', $num);
        $this->assertSame('few', $category);
    }

    public function provideFewCases()
    {
        return [
            [2],
            [4],
            [22],
            [24],
            [32],
            [34],
            [42],
            [44],
            [52],
            [54],
            [62],
            [102],
            [1002],
        ];
    }

    /**
     * @dataProvider provideManyCases
     */
    public function testMany(int|float|string $num)
    {
        $category = PluralRules::select('pl', $num);
        $this->assertSame('many', $category);
    }

    public function provideManyCases()
    {
        return [
            [0],
            [5],
            [19],
            [100],
            [1000],
            [10000],
            [100000],
            [1000000],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num)
    {
        $category = PluralRules::select('pl', $num);
        $this->assertSame('other', $category);
    }

    public function provideOtherCases()
    {
        return [
            [0.0],
            [1.5],
            [10.0],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }
}
