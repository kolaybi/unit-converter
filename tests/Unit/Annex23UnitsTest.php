<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\Enums\UnitCategory;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;
use KolayBi\UnitConverter\Units\Counting;
use KolayBi\UnitConverter\Units\MemoryCapacity;
use KolayBi\UnitConverter\Units\SignalRate;
use KolayBi\UnitConverter\Units\TextileDensity;
use KolayBi\UnitConverter\Units\Voltage;
use KolayBi\UnitConverter\Units\Wavenumber;
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

    // ── Mass: 5 new cases ──

    #[DataProvider('massNewCasesProvider')]
    public function testMassNewCasesResolveAndConvert(
        string $code,
        string $expectedLabel,
        float $multiplierToKg,
    ): void {
        $unit = Converter::unit($code);

        $this->assertSame($code, $unit->code());
        $this->assertSame($expectedLabel, $unit->label());

        // Convert to kg (multiplier=1) to verify
        $result = Converter::convert(1)->from($code)->to('KGM');
        $this->assertEqualsWithDelta($multiplierToKg, $result->toFloat(), 0.001);
    }

    /**
     * @return iterable<string, array{string, string, float}>
     */
    public static function massNewCasesProvider(): iterable
    {
        yield 'CNT (cental UK)' => ['CNT', 'cental (UK)', 45.359237];
        yield 'CTM (metric carat)' => ['CTM', 'metric carat', 0.0002];
        yield 'LBT (troy pound US)' => ['LBT', 'troy pound (US)', 0.3732417];
        yield 'QTR (quarter UK)' => ['QTR', 'quarter (UK)', 12.70059];
        yield 'SCR (scruple)' => ['SCR', 'scruple', 0.001295982];
    }

    // ── Length: 5 new cases ──

    #[DataProvider('lengthNewCasesProvider')]
    public function testLengthNewCasesResolveAndConvert(
        string $code,
        string $expectedLabel,
        float $multiplierToM,
    ): void {
        $unit = Converter::unit($code);

        $this->assertSame($code, $unit->code());
        $this->assertSame($expectedLabel, $unit->label());

        $result = Converter::convert(1)->from($code)->to('MTR');
        $this->assertEqualsWithDelta($multiplierToM, $result->toFloat(), 0.0000001);
    }

    /**
     * @return iterable<string, array{string, string, float}>
     */
    public static function lengthNewCasesProvider(): iterable
    {
        yield 'H80 (rack unit)' => ['H80', 'rack unit', 0.04445];
        yield 'H82 (big point)' => ['H82', 'big point', 0.0003527778];
        yield 'N3 (print point)' => ['N3', 'print point', 0.000351];
        yield 'R1 (pica)' => ['R1', 'pica', 0.004217518];
        yield 'E33 (foot per thousand)' => ['E33', 'foot per thousand', 0.0003048];
    }

    // ── DimensionlessConcentration: 5 new cases ──

    #[DataProvider('dimConcNewCasesProvider')]
    public function testDimConcNewCasesResolveAndConvert(
        string $code,
        string $expectedLabel,
        float $multiplier,
    ): void {
        $unit = Converter::unit($code);

        $this->assertSame($code, $unit->code());
        $this->assertSame($expectedLabel, $unit->label());

        // Convert to percent (multiplier=0.01)
        $result = Converter::convert(1)->from($code)->to('P1');
        $this->assertEqualsWithDelta($multiplier / 0.01, $result->toFloat(), 0.0001);
    }

    /**
     * @return iterable<string, array{string, string, float}>
     */
    public static function dimConcNewCasesProvider(): iterable
    {
        yield 'H93 (percent per hundred)' => ['H93', 'percent per hundred', 0.0001];
        yield 'H94 (percent per thousand)' => ['H94', 'percent per thousand', 0.00001];
        yield 'H91 (percent per ten thousand)' => ['H91', 'percent per ten thousand', 0.000001];
        yield 'H92 (percent per hundred thousand)' => ['H92', 'percent per one hundred thousand', 0.0000001];
        yield 'Q26 (one per one)' => ['Q26', 'one per one', 1.0];
    }

    // ── Frequency: 3 new cases ──

    #[DataProvider('frequencyNewCasesProvider')]
    public function testFrequencyNewCasesResolveAndConvert(
        string $code,
        string $expectedLabel,
        float $multiplierToHz,
    ): void {
        $unit = Converter::unit($code);

        $this->assertSame($code, $unit->code());
        $this->assertSame($expectedLabel, $unit->label());

        $result = Converter::convert(1)->from($code)->to('HTZ');
        $this->assertEqualsWithDelta($multiplierToHz, $result->toFloat(), 0.0000001);
    }

    /**
     * @return iterable<string, array{string, string, float}>
     */
    public static function frequencyNewCasesProvider(): iterable
    {
        yield 'BPM (beats per minute)' => ['BPM', 'beats per minute', 0.01666666666666666];
        yield 'E91 (reciprocal day)' => ['E91', 'reciprocal day', 0.00001157407407407];
        yield 'FIT (failures in time)' => ['FIT', 'failures in time', 0.000000000000277778];
    }

    // ── Time: 2 new cases ──

    #[DataProvider('timeNewCasesProvider')]
    public function testTimeNewCasesResolveAndConvert(
        string $code,
        string $expectedLabel,
        float $multiplierToS,
    ): void {
        $unit = Converter::unit($code);

        $this->assertSame($code, $unit->code());
        $this->assertSame($expectedLabel, $unit->label());

        $result = Converter::convert(1)->from($code)->to('SEC');
        $this->assertEqualsWithDelta($multiplierToS, $result->toFloat(), 0.01);
    }

    /**
     * @return iterable<string, array{string, string, float}>
     */
    public static function timeNewCasesProvider(): iterable
    {
        yield 'M36 (30-day month)' => ['M36', '30-day month', 2592000.0];
        yield 'M37 (actual/360)' => ['M37', 'actual/360', 31104000.0];
    }

    // ── Wavenumber: 4 new cases (new category) ──

    #[DataProvider('wavenumberProvider')]
    public function testWavenumberCasesResolveAndConvert(
        string $code,
        string $expectedLabel,
        float $multiplierToBase,
    ): void {
        $unit = Converter::unit($code);

        $this->assertInstanceOf(Wavenumber::class, $unit);
        $this->assertSame($code, $unit->code());
        $this->assertSame($expectedLabel, $unit->label());
        $this->assertSame(UnitCategory::Wavenumber, $unit->category());

        // Convert to dioptre (base unit, multiplier=1)
        $result = Converter::convert(1)->from($code)->to('Q25');
        $this->assertEqualsWithDelta($multiplierToBase, $result->toFloat(), 0.001);
    }

    /**
     * @return iterable<string, array{string, string, float}>
     */
    public static function wavenumberProvider(): iterable
    {
        yield 'Q25 (dioptre)' => ['Q25', 'dioptre', 1.0];
        yield 'E90 (reciprocal centimetre)' => ['E90', 'reciprocal centimetre', 100.0];
        yield 'Q24 (reciprocal inch)' => ['Q24', 'reciprocal inch', 39.3700787];
        yield 'TPI (teeth per inch)' => ['TPI', 'teeth per inch', 39.3700787];
    }

    // ── TextileDensity: 3 new cases (new category) ──

    #[DataProvider('textileDensityProvider')]
    public function testTextileDensityCasesResolveAndConvert(
        string $code,
        string $expectedLabel,
    ): void {
        $unit = Converter::unit($code);

        $this->assertInstanceOf(TextileDensity::class, $unit);
        $this->assertSame($code, $unit->code());
        $this->assertSame($expectedLabel, $unit->label());
        $this->assertSame(UnitCategory::TextileDensity, $unit->category());
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function textileDensityProvider(): iterable
    {
        yield 'D34 (tex)' => ['D34', 'tex'];
        yield 'A47 (decitex)' => ['A47', 'decitex'];
        yield 'A49 (denier)' => ['A49', 'denier'];
    }

    public function testTexToDecitexConversion(): void
    {
        // 1 tex = 10 decitex
        $result = Converter::convert(1)->from('D34')->to('A47');
        $this->assertEqualsWithDelta(10.0, $result->toFloat(), 0.001);
    }

    // ── SignalRate: 3 new cases (new category) ──

    #[DataProvider('signalRateProvider')]
    public function testSignalRateCasesResolveAndConvert(
        string $code,
        string $expectedLabel,
        float $multiplierToBase,
    ): void {
        $unit = Converter::unit($code);

        $this->assertInstanceOf(SignalRate::class, $unit);
        $this->assertSame($code, $unit->code());
        $this->assertSame($expectedLabel, $unit->label());
        $this->assertSame(UnitCategory::SignalRate, $unit->category());

        // Convert to baud (base unit)
        $result = Converter::convert(1)->from($code)->to('J38');
        $this->assertEqualsWithDelta($multiplierToBase, $result->toFloat(), 0.001);
    }

    /**
     * @return iterable<string, array{string, string, float}>
     */
    public static function signalRateProvider(): iterable
    {
        yield 'J38 (baud)' => ['J38', 'baud', 1.0];
        yield 'K50 (kilobaud)' => ['K50', 'kilobaud', 1000.0];
        yield 'J54 (megabaud)' => ['J54', 'megabaud', 1000000.0];
    }

    // ── Area: 1 new case ──

    public function testPingResolvesAndConverts(): void
    {
        $unit = Converter::unit('E19');

        $this->assertSame('E19', $unit->code());
        $this->assertSame('ping', $unit->label());

        // 1 ping = 3.305 m²
        $result = Converter::convert(1)->from('E19')->to('MTK');
        $this->assertEqualsWithDelta(3.305, $result->toFloat(), 0.001);
    }
}
