<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class RuTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('ru', $num);
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
        ];
    }

    /**
     * @dataProvider provideFewCases
     */
    public function testFew(int|float|string $num): void
    {
        $category = PluralRules::select('ru', $num);
        $this->assertSame('few', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideFewCases(): array
    {
        return [
            [2],
            [4],
            [22],
            [24],
            [32],
            [34],
            [42],
            [44],
            [52],
            [54],
            [62],
            [102],
            [1002],
        ];
    }

    /**
     * @dataProvider provideManyCases
     */
    public function testMany(int|float|string $num): void
    {
        $category = PluralRules::select('ru', $num);
        $this->assertSame('many', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideManyCases(): array
    {
        return [
            [0],
            [5],
            [19],
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
        $category = PluralRules::select('ru', $num);
        $this->assertSame('other', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public function provideOtherCases(): array
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
}
