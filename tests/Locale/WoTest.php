<?php

namespace Major\PluralRules\Tests\Locale;

use Major\PluralRules\PluralRules;
use PHPUnit\Framework\TestCase;

final class WoTest extends TestCase
{
    /**
     * @dataProvider provideOtherCases
     */
    public function testOther(int|float|string $num)
    {
        $category = PluralRules::select('wo', $num);
        $this->assertSame('other', $category);
    }

    public function provideOtherCases()
    {
        return [
            [0],
            [15],
            [100],
            [1000],
            [10000],
            [100000],
            [1000000],
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
