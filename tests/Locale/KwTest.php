<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class KwTest extends TestCase
{
    /**
     * @dataProvider provideZeroCases
     */
    public function testZero(int|float|string $num): void
    {
        $category = PluralRules::select('kw', $num);
        $this->assertSame('zero', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideZeroCases(): array
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
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('kw', $num);
        $this->assertSame('one', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOneCases(): array
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
    public function testTwo(int|float|string $num): void
    {
        $category = PluralRules::select('kw', $num);
        $this->assertSame('two', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideTwoCases(): array
    {
        return [
            [2],
            [22],
            [42],
            [62],
            [82],
            [102],
            [122],
            [142],
            [1000],
            [10000],
            [100000],
            [2.0],
            [22.0],
            [42.0],
            [62.0],
            [82.0],
            [102.0],
            [122.0],
            [142.0],
            [1000.0],
            [10000.0],
            [100000.0],
        ];
    }

    /**
     * @dataProvider provideFewCases
     */
    public function testFew(int|float|string $num): void
    {
        $category = PluralRules::select('kw', $num);
        $this->assertSame('few', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideFewCases(): array
    {
        return [
            [3],
            [23],
            [43],
            [63],
            [83],
            [103],
            [123],
            [143],
            [1003],
            [3.0],
            [23.0],
            [43.0],
            [63.0],
            [83.0],
            [103.0],
            [123.0],
            [143.0],
            [1003.0],
        ];
    }

    /**
     * @dataProvider provideManyCases
     */
    public function testMany(int|float|string $num): void
    {
        $category = PluralRules::select('kw', $num);
        $this->assertSame('many', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideManyCases(): array
    {
        return [
            [21],
            [41],
            [61],
            [81],
            [101],
            [121],
            [141],
            [161],
            [1001],
            [21.0],
            [41.0],
            [61.0],
            [81.0],
            [101.0],
            [121.0],
            [141.0],
            [161.0],
            [1001.0],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('kw', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOtherCases(): array
    {
        return [
            [4],
            [19],
            [100],
            [1004],
            [1000000],
            [0.1],
            [0.9],
            [1.1],
            [1.7],
            [10.0],
            [100.0],
            [1000.1],
            [1000000.0],
        ];
    }
}
