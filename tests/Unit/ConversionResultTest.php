<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\ConversionResult;
use KolayBi\UnitConverter\Units\Mass;
use PHPUnit\Framework\TestCase;

final class ConversionResultTest extends TestCase
{
    public function testStoresValueAndUnits(): void
    {
        $result = new ConversionResult('22.04622621848', Mass::Kilogram, Mass::Pound);

        $this->assertSame('22.04622621848', $result->value);
        $this->assertSame(Mass::Kilogram, $result->from);
        $this->assertSame(Mass::Pound, $result->to);
    }

    public function testRound(): void
    {
        $result = new ConversionResult('22.04622621848', Mass::Kilogram, Mass::Pound);

        $this->assertSame('22.05', $result->round(2));
        $this->assertSame('22.0462', $result->round(4));
        $this->assertSame('22', $result->round(0));
    }

    public function testToFloat(): void
    {
        $result = new ConversionResult('22.04622621848', Mass::Kilogram, Mass::Pound);

        $this->assertIsFloat($result->toFloat());
        $this->assertEqualsWithDelta(22.04622621848, $result->toFloat(), 0.00000001);
    }

    public function testFormat(): void
    {
        $result = new ConversionResult('1234.5678', Mass::Kilogram, Mass::Pound);

        $this->assertSame('1,234.57', $result->format(2));
        $this->assertSame('1.234,57', $result->format(2, ',', '.'));
    }

    public function testToString(): void
    {
        $result = new ConversionResult('22.04622621848', Mass::Kilogram, Mass::Pound);

        $this->assertSame('22.04622621848', (string) $result);
    }
}
