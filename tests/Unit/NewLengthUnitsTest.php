<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\UnitResolver;
use KolayBi\UnitConverter\Units\Length;
use PHPUnit\Framework\TestCase;

final class NewLengthUnitsTest extends TestCase
{
    protected function setUp(): void
    {
        UnitResolver::reset();
    }

    public function testNewLengthUnitsResolve(): void
    {
        $this->assertSame(Length::Picometre, Converter::unit('pm'));
        $this->assertSame(Length::Picometre, Converter::unit('C52'));
        $this->assertSame(Length::Parsec, Converter::unit('pc'));
        $this->assertSame(Length::Parsec, Converter::unit('C63'));
    }

    public function testPicometreConversion(): void
    {
        // 1,000,000 pm = 1 µm
        $result = Converter::convert(1000000)->from(Length::Picometre)->to(Length::Micrometre);
        $this->assertEqualsWithDelta(1, $result->toFloat(), 0.001);
    }

    public function testParsecConversion(): void
    {
        // 1 pc ≈ 3.2616 ly
        $result = Converter::convert(1)->from(Length::Parsec)->to(Length::LightYear);
        $this->assertEqualsWithDelta(3.2616, $result->toFloat(), 0.01);
    }
}
