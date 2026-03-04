<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\UnitResolver;
use KolayBi\UnitConverter\Units\AngularImpulse;
use PHPUnit\Framework\TestCase;

final class DeprecatedB32Test extends TestCase
{
    protected function setUp(): void
    {
        UnitResolver::reset();
    }

    public function testB32Resolves(): void
    {
        $this->assertSame(AngularImpulse::KilogramSquareMetre, Converter::unit('B32'));
        $this->assertSame(AngularImpulse::KilogramSquareMetre, Converter::unit('kg·m²'));
    }

    public function testB32Conversion(): void
    {
        // B32 has multiplier 1 (same as base unit)
        $result = Converter::convert(1)
            ->from(AngularImpulse::KilogramSquareMetre)
            ->to(AngularImpulse::NewtonMetreSecond);
        $this->assertEqualsWithDelta(1, $result->toFloat(), 0.001);
    }
}
