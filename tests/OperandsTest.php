<?php

namespace Major\PluralRules\Tests;

use Generator;
use PHPUnit\Framework\TestCase;

use function Major\PluralRules\Operands\{f, i, n, t, v, w};

final class OperandsTest extends TestCase
{
    /**
     * @dataProvider provideOperandCases
     */
    public function testItCanComputeOperands($source, $n, $i, $v, $w, $f, $t): void
    {
        $this->assertSame($n, n($source));
        $this->assertSame($i, i($source));
        $this->assertSame($v, v($source));
        $this->assertSame($w, w($source));
        $this->assertSame($f, f($source));
        $this->assertSame($t, t($source));
    }

    public function provideOperandCases(): Generator
    {
        yield from [
            ['1', 1.0, 1, 0, 0, 0, 0],
            ['1.0', 1.0, 1, 1, 0, 0, 0],
            ['1.00', 1.0, 1, 2, 0, 0, 0],
            ['1.3', 1.3, 1, 1, 1, 3, 3],
            ['1.30', 1.3, 1, 2, 1, 30, 3],
            ['1.03', 1.03, 1, 2, 2, 3, 3],
            ['1.230', 1.23, 1, 3, 2, 230, 23],
            ['1200000', 1200000.0, 1200000, 0, 0, 0, 0],
            ['1200.50', 1200.5, 1200, 2, 1, 50, 5],
        ];
    }
}
