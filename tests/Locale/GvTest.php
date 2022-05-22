<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class GvTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('gv', $num);
        $this->assertSame('one', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOneCases(): array
    {
        return [
            [1],
            [11],
            [21],
            [31],
            [41],
            [51],
            [61],
            [71],
            [101],
            [1001],
        ];
    }

    /**
     * @dataProvider provideTwoCases
     */
    public function testTwo(int|float|string $num): void
    {
        $category = PluralRules::select('gv', $num);
        $this->assertSame('two', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideTwoCases(): array
    {
        return [
            [2],
            [12],
            [22],
            [32],
            [42],
            [52],
            [62],
            [72],
            [102],
            [1002],
        ];
    }

    /**
     * @dataProvider provideFewCases
     */
    public function testFew(int|float|string $num): void
    {
        $category = PluralRules::select('gv', $num);
        $this->assertSame('few', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideFewCases(): array
    {
        return [
            [0],
            [20],
            [40],
            [60],
            [80],
            [100],
            [120],
            [140],
            [1000],
            [10000],
            [100000],
            [1000000],
        ];
    }

    /**
     * @dataProvider provideManyCases
     */
    public function testMany(int|float|string $num): void
    {
        $category = PluralRules::select('gv', $num);
        $this->assertSame('many', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideManyCases(): array
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

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('gv', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOtherCases(): array
    {
        return [
            [3],
            [10],
            [13],
            [19],
            [23],
            [103],
            [1003],
        ];
    }
}
