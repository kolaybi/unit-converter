<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;
use KolayBi\UnitConverter\Units\Packaging;
use PHPUnit\Framework\TestCase;

final class PackagingTest extends TestCase
{
    public function testImplementsUnitInterface(): void
    {
        $this->assertInstanceOf(Unit::class, Packaging::Box);
    }

    public function testBox(): void
    {
        $this->assertSame('BX', Packaging::Box->value);
        $this->assertSame('box', Packaging::Box->label());
        $this->assertSame(UnitCategory::Packaging, Packaging::Box->category());
    }

    public function testCategoryIsNotConvertible(): void
    {
        $this->assertFalse(UnitCategory::Packaging->isConvertible());
    }

    public function testMultiplierAndOffsetAreZero(): void
    {
        foreach (Packaging::cases() as $case) {
            $this->assertSame('0', $case->multiplier());
            $this->assertSame('0', $case->offset());
        }
    }
}
