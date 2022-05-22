<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class TzmTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('tzm', $num);
        $this->assertSame('one', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOneCases(): array
    {
        return [
            [0],
            [1],
            [11],
            [24],
            [0.0],
            [1.0],
            [11.0],
            [12.0],
            [13.0],
            [14.0],
            [15.0],
            [16.0],
            [17.0],
            [18.0],
            [19.0],
            [20.0],
            [21.0],
            [22.0],
            [23.0],
            [24.0],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('tzm', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOtherCases(): array
    {
        return [
            [2],
            [10],
            [100],
            [106],
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
