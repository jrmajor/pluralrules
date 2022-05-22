<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class PrgTest extends TestCase
{
    /**
     * @dataProvider provideZeroCases
     */
    public function testZero(int|float|string $num): void
    {
        $category = PluralRules::select('prg', $num);
        $this->assertSame('zero', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideZeroCases(): array
    {
        return [
            [0],
            [10],
            [20],
            [30],
            [40],
            [50],
            [60],
            [100],
            [1000],
            [10000],
            [100000],
            [1000000],
            [0.0],
            [10.0],
            [11.0],
            [12.0],
            [13.0],
            [14.0],
            [15.0],
            [16.0],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }

    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('prg', $num);
        $this->assertSame('one', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOneCases(): array
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
            [1.0],
            [1.1],
            [2.1],
            [3.1],
            [4.1],
            [5.1],
            [6.1],
            [7.1],
            [10.1],
            [100.1],
            [1000.1],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('prg', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOtherCases(): array
    {
        return [
            [2],
            [9],
            [22],
            [29],
            [102],
            [1002],
            [0.2],
            [0.9],
            [1.2],
            [1.9],
            [10.2],
            [100.2],
            [1000.2],
        ];
    }
}
