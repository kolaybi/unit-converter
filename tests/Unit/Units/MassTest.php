<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;
use KolayBi\UnitConverter\Units\Mass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class MassTest extends TestCase
{
    public function testImplementsUnitInterface(): void
    {
        $this->assertInstanceOf(Unit::class, Mass::Kilogram);
    }

    public function testKilogramIsBaseUnit(): void
    {
        $this->assertSame('KGM', Mass::Kilogram->value);
        $this->assertSame('kg', Mass::Kilogram->symbol());
        $this->assertSame('kilogram', Mass::Kilogram->label());
        $this->assertSame('1', Mass::Kilogram->multiplier());
        $this->assertSame('0', Mass::Kilogram->offset());
        $this->assertSame(UnitCategory::Mass, Mass::Kilogram->category());
    }

    public function testGramMultiplier(): void
    {
        $this->assertSame('0.001', Mass::Gram->multiplier());
        $this->assertSame('g', Mass::Gram->symbol());
        $this->assertSame('GRM', Mass::Gram->value);
    }

    public function testPoundMultiplier(): void
    {
        $this->assertSame('0.45359237', Mass::Pound->multiplier());
        $this->assertSame('lb', Mass::Pound->symbol());
        $this->assertSame('LBR', Mass::Pound->value);
    }

    public function testAliasesContainCodeSymbolAndLabel(): void
    {
        $aliases = Mass::Kilogram->aliases();

        $this->assertContains('KGM', $aliases);
        $this->assertContains('kg', $aliases);
        $this->assertContains('kilogram', $aliases);
    }

    public function testAllCasesHaveZeroOffset(): void
    {
        foreach (Mass::cases() as $case) {
            $this->assertSame('0', $case->offset(), "{$case->name} should have zero offset");
        }
    }

    public function testHasExpectedCaseCount(): void
    {
        $this->assertCount(29, Mass::cases());
    }

    #[DataProvider('allCasesProvider')]
    public function testEveryCaseHasValidData(Mass $unit): void
    {
        $this->assertNotEmpty($unit->value, "{$unit->name} must have a UN/CEFACT code");
        $this->assertNotEmpty($unit->symbol(), "{$unit->name} must have a symbol");
        $this->assertNotEmpty($unit->label(), "{$unit->name} must have a label");
        $this->assertNotEmpty($unit->multiplier(), "{$unit->name} must have a multiplier");
        $this->assertIsNumeric(
            $unit->multiplier(),
            "{$unit->name} multiplier must be numeric, got: {$unit->multiplier()}",
        );
    }

    /**
     * @return iterable<string, array{Mass}>
     */
    public static function allCasesProvider(): iterable
    {
        foreach (Mass::cases() as $case) {
            yield $case->name => [$case];
        }
    }
}
