<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class BnTest extends TestCase
{
    /**
     * @dataProvider provideOneCases
     */
    public function testOne(int|float|string $num)
    {
        $category = PluralRules::select('bn', $num);
        $this->assertSame('one', $category);
    }

    public function provideOneCases()
    {
        return [
            [0],
            [1],
            [0.0],
            [1.0],
            ['0.00'],
            [0.04],
        ];
    }

    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num)
    {
        $category = PluralRules::select('bn', $num);
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
            [1000000],
            [1.1],
            [2.6],
            [10.0],
            [100.0],
            [1000.0],
            [10000.0],
            [100000.0],
            [1000000.0],
        ];
    }
}
