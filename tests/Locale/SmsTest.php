<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class SmsTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('sms', $num);
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
     * @dataProvider provideTwoCases
     */
    public function testTwo(int|float|string $num): void
    {
        $category = PluralRules::select('sms', $num);
        $this->assertSame('two', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideTwoCases(): array
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
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('sms', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideOtherCases(): array
    {
        return [
            [0],
            [3],
            [17],
            [100],
            [1000],
            [10000],
            [100000],
            [1000000],
            [0.0],
            [0.9],
            [1.1],
            [1.6],
            [10.0],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }
}
