<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class GaTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('ga', $num);
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
        $category = PluralRules::select('ga', $num);
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
        $category = PluralRules::select('ga', $num);
        $this->assertSame('few', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideFewCases(): array
    {
        return [
            [3],
            [6],
            [3.0],
            [4.0],
            [5.0],
            [6.0],
            ['3.00'],
            ['4.00'],
            ['5.00'],
            ['6.00'],
            ['3.000'],
            ['4.000'],
            ['5.000'],
            ['6.000'],
            ['3.0000'],
            ['4.0000'],
            ['5.0000'],
            ['6.0000'],
        ];
    }

    /**
     * @dataProvider provideManyCases
     */
    public function testMany(int|float|string $num): void
    {
        $category = PluralRules::select('ga', $num);
        $this->assertSame('many', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideManyCases(): array
    {
        return [
            [7],
            [10],
            [7.0],
            [8.0],
            [9.0],
            [10.0],
            ['7.00'],
            ['8.00'],
            ['9.00'],
            ['10.00'],
            ['7.000'],
            ['8.000'],
            ['9.000'],
            ['10.000'],
            ['7.0000'],
            ['8.0000'],
            ['9.0000'],
            ['10.0000'],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('ga', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOtherCases(): array
    {
        return [
            [0],
            [11],
            [25],
            [100],
            [1000],
            [10000],
            [100000],
            [1000000],
            [0.0],
            [0.9],
            [1.1],
            [1.6],
            [10.1],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }
}
