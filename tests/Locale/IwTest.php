<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class IwTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('iw', $num);
        $this->assertSame('one', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOneCases(): array
    {
        return [
            [1],
        ];
    }

    /**
     * @dataProvider provideTwoCases
     */
    public function testTwo(int|float|string $num): void
    {
        $category = PluralRules::select('iw', $num);
        $this->assertSame('two', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideTwoCases(): array
    {
        return [
            [2],
        ];
    }

    /**
     * @dataProvider provideManyCases
     */
    public function testMany(int|float|string $num): void
    {
        $category = PluralRules::select('iw', $num);
        $this->assertSame('many', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideManyCases(): array
    {
        return [
            [20],
            [30],
            [40],
            [50],
            [60],
            [70],
            [80],
            [90],
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
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('iw', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOtherCases(): array
    {
        return [
            [0],
            [3],
            [17],
            [101],
            [1001],
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
