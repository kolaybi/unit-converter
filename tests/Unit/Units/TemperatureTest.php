<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Units\Temperature;
use PHPUnit\Framework\TestCase;

final class TemperatureTest extends TestCase
{
    public function testImplementsUnitInterface(): void
    {
        $this->assertInstanceOf(Unit::class, Temperature::Kelvin);
    }

    public function testKelvinIsBaseUnit(): void
    {
        $this->assertSame('KEL', Temperature::Kelvin->value);
        $this->assertSame('1', Temperature::Kelvin->multiplier());
        $this->assertSame('0', Temperature::Kelvin->offset());
    }

    public function testCelsiusHasOffset(): void
    {
        $this->assertSame('CEL', Temperature::Celsius->value);
        $this->assertSame('1', Temperature::Celsius->multiplier());
        $this->assertSame('273.15', Temperature::Celsius->offset());
    }

    public function testFahrenheitHasMultiplierAndOffset(): void
    {
        $this->assertSame('FAH', Temperature::Fahrenheit->value);
        $this->assertSame('0.5555555555555556', Temperature::Fahrenheit->multiplier());
        $this->assertSame('255.3722222222222', Temperature::Fahrenheit->offset());
    }

    public function testRankine(): void
    {
        $this->assertSame('A48', Temperature::Rankine->value);
        $this->assertSame('0.5555555555555556', Temperature::Rankine->multiplier());
        $this->assertSame('0', Temperature::Rankine->offset());
    }

    public function testHasFourCases(): void
    {
        $this->assertCount(4, Temperature::cases());
    }
}
