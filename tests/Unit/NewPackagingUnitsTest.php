<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\UnitResolver;
use KolayBi\UnitConverter\Units\Packaging;
use PHPUnit\Framework\TestCase;

final class NewPackagingUnitsTest extends TestCase
{
    protected function setUp(): void
    {
        UnitResolver::reset();
    }

    public function testNewPackagingUnitsResolve(): void
    {
        $this->assertSame(Packaging::Deck, Converter::unit('DK'));
        $this->assertSame(Packaging::Kit, Converter::unit('KI'));
        $this->assertSame(Packaging::Pellet, Converter::unit('XPE'));
    }

    public function testDeprecatedPackagingCodesResolve(): void
    {
        $this->assertSame(Packaging::CarryingCapacityInMetricTonnes, Converter::unit('CCT'));
        $this->assertSame(Packaging::GrossTonnage, Converter::unit('GT'));
        $this->assertSame(Packaging::NumberOfCells, Converter::unit('NCL'));
        $this->assertSame(Packaging::TankCylindrical, Converter::unit('TK'));
    }

    public function testPackagingUnitsAreNonConvertible(): void
    {
        $this->assertSame('0', Packaging::Deck->multiplier());
        $this->assertSame('0', Packaging::CarryingCapacityInMetricTonnes->multiplier());
        $this->assertSame('0', Packaging::GrossTonnage->multiplier());
    }
}
