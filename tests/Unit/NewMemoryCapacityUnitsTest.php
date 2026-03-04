<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\UnitResolver;
use KolayBi\UnitConverter\Units\MemoryCapacity;
use PHPUnit\Framework\TestCase;

final class NewMemoryCapacityUnitsTest extends TestCase
{
    protected function setUp(): void
    {
        UnitResolver::reset();
    }

    public function testNewMemoryCapacityUnitsResolve(): void
    {
        $this->assertSame(MemoryCapacity::Bit, Converter::unit('bit'));
        $this->assertSame(MemoryCapacity::Kilobit, Converter::unit('Kbit'));
        $this->assertSame(MemoryCapacity::Gigabit, Converter::unit('Gbit'));
    }

    public function testBitConversion(): void
    {
        // 8 bits = 1 byte
        $result = Converter::convert(8)->from(MemoryCapacity::Bit)->to(MemoryCapacity::Byte);
        $this->assertEqualsWithDelta(1, $result->toFloat(), 0.001);
    }

    public function testKilobitConversion(): void
    {
        // 1 Kbit = 125 bytes = 0.125 kbytes
        $result = Converter::convert(1)->from(MemoryCapacity::Kilobit)->to(MemoryCapacity::Byte);
        $this->assertEqualsWithDelta(125, $result->toFloat(), 0.1);
    }

    public function testGigabitConversion(): void
    {
        // 1 Gbit = 125,000,000 bytes = 0.125 GB
        $result = Converter::convert(8)->from(MemoryCapacity::Gigabit)->to(MemoryCapacity::Gigabyte);
        $this->assertEqualsWithDelta(1, $result->toFloat(), 0.001);
    }
}
