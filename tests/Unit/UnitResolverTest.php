<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Exceptions\UnitNotFoundException;
use KolayBi\UnitConverter\UnitResolver;
use KolayBi\UnitConverter\Units\Counting;
use KolayBi\UnitConverter\Units\Mass;
use KolayBi\UnitConverter\Units\Packaging;
use KolayBi\UnitConverter\Units\Temperature;
use PHPUnit\Framework\TestCase;

final class UnitResolverTest extends TestCase
{
    protected function setUp(): void
    {
        UnitResolver::reset();
    }

    public function testResolveByUncefactCode(): void
    {
        $this->assertSame(Mass::Kilogram, UnitResolver::resolve('KGM'));
        $this->assertSame(Temperature::Celsius, UnitResolver::resolve('CEL'));
        $this->assertSame(Packaging::Box, UnitResolver::resolve('BX'));
    }

    public function testResolveBySymbol(): void
    {
        $this->assertSame(Mass::Kilogram, UnitResolver::resolve('kg'));
        $this->assertSame(Mass::Gram, UnitResolver::resolve('g'));
        $this->assertSame(Mass::Pound, UnitResolver::resolve('lb'));
    }

    public function testResolveByLabel(): void
    {
        $this->assertSame(Mass::Kilogram, UnitResolver::resolve('kilogram'));
        $this->assertSame(Temperature::Celsius, UnitResolver::resolve('degrees Celsius'));
    }

    public function testResolveCaseInsensitive(): void
    {
        $this->assertSame(Mass::Kilogram, UnitResolver::resolve('KILOGRAM'));
        $this->assertSame(Mass::Kilogram, UnitResolver::resolve('Kilogram'));
    }

    public function testResolveUnknownThrows(): void
    {
        $this->expectException(UnitNotFoundException::class);

        UnitResolver::resolve('unknown_unit');
    }

    public function testResolveCountingUnits(): void
    {
        $this->assertSame(Counting::Each, UnitResolver::resolve('C62'));
        $this->assertSame(Counting::Dozen, UnitResolver::resolve('DZN'));
    }
}
