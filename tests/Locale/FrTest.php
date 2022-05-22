<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class FrTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num)
    {
        $category = PluralRules::select('fr', $num);
        $this->assertSame('one', $category);
    }

    public function provideOneCases()
    {
        return [
            [0],
            [1],
            [0.0],
            [1.5],
        ];
    }

    /**
     * @dataProvider provideManyCases
     */
    public function testMany(int|float|string $num)
    {
        $category = PluralRules::select('fr', $num);
        $this->assertSame('many', $category);
    }

    public function provideManyCases()
    {
        return [
            [1000000],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num)
    {
        $category = PluralRules::select('fr', $num);
        $this->assertSame('other', $category);
    }

    public function provideOtherCases()
    {
        return [
            [2],
            [17],
            [100],
            [1000],
            [10000],
            [100000],
            [2.0],
            [3.5],
            [10.0],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }
}
