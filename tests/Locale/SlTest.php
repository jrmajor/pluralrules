<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SlTest extends TestCase
{
    #[DataProvider('provideOneCases')]
    public function testOne(int|float|string $num): void
    {
        $category = PluralRules::select('sl', $num);
        $this->assertSame('one', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideOneCases(): array
    {
        return [
            [1],
            [101],
            [201],
            [301],
            [401],
            [501],
            [601],
            [701],
            [1001],
        ];
    }

    #[DataProvider('provideTwoCases')]
    public function testTwo(int|float|string $num): void
    {
        $category = PluralRules::select('sl', $num);
        $this->assertSame('two', $category);
    }

    /**
     * @return list<array{int|float|string}>
     */
    public static function provideTwoCases(): array
    {
        return [
            [2],
            [102],
            [202],
            [302],
            [402],
            [502],
            [602],
            [702],
            [1002],
        ];
    }

    #[DataProvider('provideFewCases')]
    public function testFew(int|float|string $num): void
    {
        $category = PluralRules::select('sl', $num);
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
            [103],
            [104],
            [203],
            [204],
            [303],
            [304],
            [403],
            [404],
            [503],
            [504],
            [603],
            [604],
            [703],
            [704],
            [1003],
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

    #[DataProvider('provideOtherCases')]
    public function testOther(int|float|string $num): void
    {
        $category = PluralRules::select('sl', $num);
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
            [19],
            [100],
            [1000],
            [10000],
            [100000],
            [1000000],
        ];
    }
}
