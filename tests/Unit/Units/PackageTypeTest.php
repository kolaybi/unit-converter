<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;
use KolayBi\UnitConverter\UnitResolver;
use KolayBi\UnitConverter\Units\Counting;
use KolayBi\UnitConverter\Units\Mass;
use KolayBi\UnitConverter\Units\Packaging;
use KolayBi\UnitConverter\Units\PackageType;
use KolayBi\UnitConverter\Units\Trade;
use KolayBi\UnitConverter\Units\Volume;
use KolayBi\UnitConverter\Converter;
use PHPUnit\Framework\TestCase;

final class PackageTypeTest extends TestCase
{
    protected function setUp(): void
    {
        UnitResolver::reset();
    }

    public function testCaseCount(): void
    {
        $this->assertCount(406, PackageType::cases());
    }

    public function testImplementsUnitInterface(): void
    {
        $this->assertInstanceOf(Unit::class, PackageType::Bag);
    }

    public function testCategoryIsPackageType(): void
    {
        $this->assertSame(UnitCategory::PackageType, PackageType::Bag->category());
    }

    public function testCategoryIsNotConvertible(): void
    {
        $this->assertFalse(UnitCategory::PackageType->isConvertible());
    }

    public function testMultiplierAndOffsetAreZero(): void
    {
        foreach (PackageType::cases() as $case) {
            $this->assertSame('0', $case->multiplier(), "Multiplier should be 0 for {$case->name}");
            $this->assertSame('0', $case->offset(), "Offset should be 0 for {$case->name}");
        }
    }

    public function testAllCodesAreXPrefixed(): void
    {
        foreach (PackageType::cases() as $case) {
            $this->assertStringStartsWith('X', $case->code(), "{$case->name} code should be X-prefixed");
        }
    }

    public function testRec21CodeStripsXPrefix(): void
    {
        $this->assertSame('BG', PackageType::Bag->rec21Code());
        $this->assertSame('1A', PackageType::DrumSteel->rec21Code());
        $this->assertSame('AE', PackageType::Aerosol->rec21Code());
    }

    public function testResolveByXPrefixedCode(): void
    {
        $this->assertSame(PackageType::Bag, Converter::unit('XBG'));
        $this->assertSame(PackageType::DrumSteel, Converter::unit('X1A'));
        $this->assertSame(PackageType::Aerosol, Converter::unit('XAE'));
        $this->assertSame(PackageType::Box, Converter::unit('XBX'));
        $this->assertSame(PackageType::Barrel, Converter::unit('XBA'));
        $this->assertSame(PackageType::Pallet, Converter::unit('XPX'));
    }

    public function testResolveByLabel(): void
    {
        $this->assertSame(PackageType::Aerosol, Converter::unit('aerosol'));
        $this->assertSame(PackageType::DrumSteel, Converter::unit('drum, steel'));
        $this->assertSame(PackageType::Clamshell, Converter::unit('clamshell'));
    }

    /**
     * Rec 20 Packaging codes must take priority over Rec 21 native aliases.
     * These 23 codes exist in both standards.
     */
    public function testRec20PackagingTakesPriorityOverRec21Aliases(): void
    {
        // These should resolve to Rec 20 Packaging, not Rec 21 PackageType
        $this->assertSame(Packaging::Bag, Converter::unit('BG'));
        $this->assertSame(Packaging::Box, Converter::unit('BX'));
        $this->assertSame(Packaging::Drum, Converter::unit('DR'));
        $this->assertSame(Packaging::Tube, Converter::unit('TU'));
        $this->assertSame(Packaging::Tin, Converter::unit('TN'));
        $this->assertSame(Packaging::Sack, Converter::unit('SA'));
        $this->assertSame(Packaging::Roll, Converter::unit('RO'));
        $this->assertSame(Packaging::Reel, Converter::unit('RL'));
        $this->assertSame(Packaging::Packet, Converter::unit('PA'));
        $this->assertSame(Packaging::Pack, Converter::unit('PK'));
    }

    /**
     * Physical unit symbols must not be shadowed by PackageType aliases.
     */
    public function testPhysicalUnitSymbolsNotShadowed(): void
    {
        // 'lt' is both Volume::Litre alias and Rec 21 code LT (Lot)
        $this->assertSame(Volume::Litre, Converter::unit('lt'));

        // Other physical units that could conflict
        $this->assertSame(Mass::Kilogram, Converter::unit('kg'));
        $this->assertSame(Mass::Gram, Converter::unit('g'));

        // Counting units
        $this->assertSame(Counting::Each, Converter::unit('C62'));
    }

    /**
     * Non-conflicting Rec 21 native codes should resolve to PackageType.
     * Codes starting with digits or those not used by Rec 20 Trade/Packaging.
     */
    public function testNonConflictingNativeCodesResolve(): void
    {
        $this->assertSame(PackageType::DrumSteel, Converter::unit('1A'));
        $this->assertSame(PackageType::JerricanSteel, Converter::unit('3A'));
        $this->assertSame(PackageType::BoxSteel, Converter::unit('4A'));
        $this->assertSame(PackageType::BagWovenPlastic, Converter::unit('5H'));
        $this->assertSame(PackageType::PalletWooden, Converter::unit('8A'));
    }

    public function testConversionThrowsNonConvertible(): void
    {
        $this->expectException(NonConvertibleUnitException::class);

        Converter::convert(1)->from(PackageType::Bag)->to(PackageType::Box);
    }

    public function testEnumClassMapping(): void
    {
        $this->assertSame(
            PackageType::class,
            UnitCategory::PackageType->enumClass()
        );
    }

    public function testAliasesContainXPrefixedAndNativeCode(): void
    {
        $aliases = PackageType::Bag->aliases();

        $this->assertContains('XBG', $aliases);
        $this->assertContains('BG', $aliases);
        $this->assertContains('bag', $aliases);
    }

    /**
     * Spot-check specific entries from the Rec 21 data.
     */
    public function testSpecificEntries(): void
    {
        $this->assertSame('X1A', PackageType::DrumSteel->code());
        $this->assertSame('drum, steel', PackageType::DrumSteel->label());

        $this->assertSame('X43', PackageType::BagSuperBulk->code());
        $this->assertSame('bag, super bulk', PackageType::BagSuperBulk->label());

        $this->assertSame('XZZ', PackageType::MutuallyDefined->code());
        $this->assertSame('mutually defined', PackageType::MutuallyDefined->label());
    }
}
