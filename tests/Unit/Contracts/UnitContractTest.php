<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit\Contracts;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;
use PHPUnit\Framework\TestCase;

final class UnitContractTest extends TestCase
{
    public function test_unit_interface_defines_required_methods(): void
    {
        $reflection = new \ReflectionClass(Unit::class);

        $this->assertTrue($reflection->isInterface());
        $this->assertTrue($reflection->hasMethod('symbol'));
        $this->assertTrue($reflection->hasMethod('label'));
        $this->assertTrue($reflection->hasMethod('aliases'));
        $this->assertTrue($reflection->hasMethod('multiplier'));
        $this->assertTrue($reflection->hasMethod('offset'));
        $this->assertTrue($reflection->hasMethod('category'));
    }

    public function test_unit_category_has_expected_cases(): void
    {
        $cases = UnitCategory::cases();

        $this->assertContains(UnitCategory::Mass, $cases);
        $this->assertContains(UnitCategory::Length, $cases);
        $this->assertContains(UnitCategory::Temperature, $cases);
        $this->assertContains(UnitCategory::Volume, $cases);
        $this->assertContains(UnitCategory::Packaging, $cases);
        $this->assertContains(UnitCategory::Counting, $cases);
    }

    public function test_unit_category_returns_enum_class(): void
    {
        $enumClass = UnitCategory::Mass->enumClass();

        $this->assertTrue(
            is_a($enumClass, Unit::class, true),
            "Mass enum class must implement Unit interface"
        );
    }
}
