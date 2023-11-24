<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class BloTest extends TestCase
{
    /**
     * @dataProvider provideZeroCases
     */
    public function testZero(int|float|string $num): void
    {
        $category = PluralRules::select('blo', $num);
        $this->assertSame('zero', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideZeroCases(): array
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
        $category = PluralRules::select('blo', $num);
        $this->assertSame('one', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideOneCases(): array
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
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('blo', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideOtherCases(): array
    {
        return [
            [2],
            [16],
            [100],
            [1000],
            [10000],
            [100000],
            [1000000],
            [2.0],
            [2.5],
            [10.0],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }
}
