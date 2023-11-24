<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class BrTest extends TestCase
{
    #[DataProvider('provideOneCases')]
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('br', $num);
        $this->assertSame('one', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideOneCases(): array
    {
        return [
            [1],
            [21],
            [31],
            [41],
            [51],
            [61],
            [81],
            [101],
            [1001],
            [1.0],
            [21.0],
            [31.0],
            [41.0],
            [51.0],
            [61.0],
            [81.0],
            [101.0],
            [1001.0],
        ];
    }

    #[DataProvider('provideTwoCases')]
    public function testTwo(int|float|string $num): void
    {
        $category = PluralRules::select('br', $num);
        $this->assertSame('two', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideTwoCases(): array
    {
        return [
            [2],
            [22],
            [32],
            [42],
            [52],
            [62],
            [82],
            [102],
            [1002],
            [2.0],
            [22.0],
            [32.0],
            [42.0],
            [52.0],
            [62.0],
            [82.0],
            [102.0],
            [1002.0],
        ];
    }

    #[DataProvider('provideFewCases')]
    public function testFew(int|float|string $num): void
    {
        $category = PluralRules::select('br', $num);
        $this->assertSame('few', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideFewCases(): array
    {
        return [
            [3],
            [4],
            [9],
            [23],
            [24],
            [29],
            [33],
            [34],
            [39],
            [43],
            [44],
            [49],
            [103],
            [1003],
            [3.0],
            [4.0],
            [9.0],
            [23.0],
            [24.0],
            [29.0],
            [33.0],
            [34.0],
            [103.0],
            [1003.0],
        ];
    }

    #[DataProvider('provideManyCases')]
    public function testMany(int|float|string $num): void
    {
        $category = PluralRules::select('br', $num);
        $this->assertSame('many', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideManyCases(): array
    {
        return [
            [1000000],
            [1000000.0],
            ['1000000.00'],
            ['1000000.000'],
            ['1000000.0000'],
        ];
    }

    #[DataProvider('provideOtherCases')]
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('br', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideOtherCases(): array
    {
        return [
            [0],
            [5],
            [8],
            [10],
            [20],
            [100],
            [1000],
            [10000],
            [100000],
            [0.0],
            [0.9],
            [1.1],
            [1.6],
            [10.0],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
        ];
    }
}
