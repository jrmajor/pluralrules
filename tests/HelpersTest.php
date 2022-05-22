<?php

namespace Major\PluralRules\Tests;

use Generator;
use Major\PluralRules\Dev\Helpers as H;
use PHPUnit\Framework\TestCase;

use function Major\PluralRules\Operands\{f, i, n, t, v, w};

final class HelpersTest extends TestCase
{
    /**
     * @dataProvider provideStudlyCases
     *
     * @param list<string> $pieces
     */
    public function testStudlyHelperWorks(array $pieces, string $expected): void
    {
        $this->assertSame($expected, H\studly(...$pieces));
    }

    public function provideStudlyCases(): Generator
    {
        yield from [
            [['foo-bar', 'baz'], 'FooBarBaz'],
            [['foo bar_baz'], 'FooBarBaz'],
            [['Foo Bar baz'], 'FooBarBaz'],
        ];
    }

    /**
     * @dataProvider provideCamelCases
     *
     * @param list<string> $pieces
     */
    public function testCamelHelperWorks(array $pieces, string $expected): void
    {
        $this->assertSame($expected, H\camel(...$pieces));
    }

    public function provideCamelCases(): Generator
    {
        yield from [
            [['foo-bar', 'baz'], 'fooBarBaz'],
            [['foo bar_baz'], 'fooBarBaz'],
            [['Foo Bar baz'], 'fooBarBaz'],
        ];
    }
}
