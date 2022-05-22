<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class CyTest extends TestCase
{
    /**
     * @dataProvider provideZeroCases
     */
    public function testZero(int|float|string $num): void
    {
        $category = PluralRules::select('cy', $num);
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
        $category = PluralRules::select('cy', $num);
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
        $category = PluralRules::select('cy', $num);
        $this->assertSame('two', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideTwoCases(): array
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
    public function testFew(int|float|string $num): void
    {
        $category = PluralRules::select('cy', $num);
        $this->assertSame('few', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideFewCases(): array
    {
        return [
            [3],
            [3.0],
            ['3.00'],
            ['3.000'],
            ['3.0000'],
        ];
    }

    /**
     * @dataProvider provideManyCases
     */
    public function testMany(int|float|string $num): void
    {
        $category = PluralRules::select('cy', $num);
        $this->assertSame('many', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideManyCases(): array
    {
        return [
            [6],
            [6.0],
            ['6.00'],
            ['6.000'],
            ['6.0000'],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('cy', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOtherCases(): array
    {
        return [
            [4],
            [5],
            [7],
            [20],
            [100],
            [1000],
            [10000],
            [100000],
            [1000000],
            [0.1],
            [0.9],
            [1.1],
            [1.7],
            [10.0],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }
}
