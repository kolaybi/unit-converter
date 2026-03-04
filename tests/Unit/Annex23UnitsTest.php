<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;
use KolayBi\UnitConverter\Units\Counting;
use KolayBi\UnitConverter\Units\MemoryCapacity;
use KolayBi\UnitConverter\Units\Voltage;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class Annex23UnitsTest extends TestCase
{
    // ── Aliases ──

    #[DataProvider('countingAliasProvider')]
    public function testCountingAliasesResolveToEach(string $aliasCode): void
    {
        $unit = Converter::unit($aliasCode);

        $this->assertSame(Counting::Each, $unit);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function countingAliasProvider(): iterable
    {
        yield 'EA' => ['EA'];
        yield 'H87' => ['H87'];
        yield 'NAR' => ['NAR'];
    }

    #[DataProvider('voltageAliasProvider')]
    public function testVoltageAliasesResolveToVolt(string $aliasCode): void
    {
        $unit = Converter::unit($aliasCode);

        $this->assertSame(Voltage::Volt, $unit);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function voltageAliasProvider(): iterable
    {
        yield '2G' => ['2G'];
        yield '2H' => ['2H'];
    }

    // ── Memory Capacity: new bit-based cases ──

    public function testBitResolvesAndConverts(): void
    {
        $unit = Converter::unit('A99');

        $this->assertSame(MemoryCapacity::Bit, $unit);
        $this->assertSame('A99', $unit->code());

        // 8 bits = 1 byte
        $result = Converter::convert(8)->from('A99')->to('AD');
        $this->assertEqualsWithDelta(1.0, $result->toFloat(), 0.0001);
    }

    public function testKilobitResolvesAndConverts(): void
    {
        $unit = Converter::unit('C37');

        $this->assertSame(MemoryCapacity::Kilobit, $unit);

        // 1 kilobit = 1000 bits = 125 bytes
        $result = Converter::convert(1)->from('C37')->to('AD');
        $this->assertEqualsWithDelta(125.0, $result->toFloat(), 0.0001);
    }

    public function testGigabitResolvesAndConverts(): void
    {
        $unit = Converter::unit('B68');

        $this->assertSame(MemoryCapacity::Gigabit, $unit);

        // 1 gigabit = 10^9 bits = 125000000 bytes
        $result = Converter::convert(1)->from('B68')->to('AD');
        $this->assertEqualsWithDelta(125000000.0, $result->toFloat(), 0.01);
    }

    // ── Counting: new convertible cases ──

    #[DataProvider('countingNewCasesProvider')]
    public function testCountingNewCasesResolveAndConvert(
        string $code,
        string $expectedLabel,
        float $expectedPerDozen,
    ): void {
        $unit = Converter::unit($code);

        $this->assertSame($code, $unit->code());
        $this->assertSame($expectedLabel, $unit->label());

        // Convert to dozens (multiplier=12) to verify
        $result = Converter::convert(1)->from($code)->to('DZN');
        $this->assertEqualsWithDelta($expectedPerDozen, $result->toFloat(), 0.0001);
    }

    /**
     * @return iterable<string, array{string, string, float}>
     */
    public static function countingNewCasesProvider(): iterable
    {
        // code, label, expected_per_dozen (multiplier/12)
        yield 'GRO (gross)' => ['GRO', 'gross', 12.0];
        yield 'GGR (great gross)' => ['GGR', 'great gross', 144.0];
        yield 'SCO (score)' => ['SCO', 'score', 1.6666666666666];
        yield 'MIL (thousand)' => ['MIL', 'thousand', 83.3333333333333];
        yield 'MIO (million)' => ['MIO', 'million', 83333.3333333333];
        yield 'MLD (milliard)' => ['MLD', 'milliard', 83333333.3333333];
        yield 'BIL (billion EUR)' => ['BIL', 'billion (EUR)', 83333333333.3333];
        yield 'TRL (trillion EUR)' => ['TRL', 'trillion (EUR)', 83333333333333333.3333];
    }

    public function testGrossToDozenConversion(): void
    {
        // 1 gross = 144 items = 12 dozen
        $result = Converter::convert(1)->from('GRO')->to('DZN');
        $this->assertEqualsWithDelta(12.0, $result->toFloat(), 0.0001);
    }
}
