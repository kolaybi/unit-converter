<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\UnitResolver;
use KolayBi\UnitConverter\Units\Power;
use PHPUnit\Framework\TestCase;

final class NewPowerUnitsTest extends TestCase
{
    protected function setUp(): void
    {
        UnitResolver::reset();
    }

    public function testNewPowerUnitsResolve(): void
    {
        $this->assertSame(Power::KilowattPeak, Converter::unit('kWp'));
        $this->assertSame(Power::MegawattPeak, Converter::unit('MWp'));
    }

    public function testKilowattPeakConversion(): void
    {
        // 1 kWp = 1 kW (physically equivalent)
        $result = Converter::convert(1)->from(Power::KilowattPeak)->to(Power::Kilowatt);
        $this->assertEqualsWithDelta(1, $result->toFloat(), 0.001);
    }

    public function testMegawattPeakConversion(): void
    {
        // 1 MWp = 1000 kW
        $result = Converter::convert(1)->from(Power::MegawattPeak)->to(Power::Kilowatt);
        $this->assertEqualsWithDelta(1000, $result->toFloat(), 0.1);
    }
}
