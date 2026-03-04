<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\ConversionResult;
use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\Exceptions\IncompatibleUnitsException;
use KolayBi\UnitConverter\Exceptions\UnitNotFoundException;
use KolayBi\UnitConverter\PendingConversion;
use KolayBi\UnitConverter\Units\Mass;
use KolayBi\UnitConverter\Units\Temperature;
use PHPUnit\Framework\TestCase;

final class ConverterTest extends TestCase
{
    // --- Fluent API ---

    public function testConvertReturnsPendingConversion(): void
    {
        $pending = Converter::convert(10);

        $this->assertInstanceOf(PendingConversion::class, $pending);
    }

    public function testFullFluentChainWithEnums(): void
    {
        $result = Converter::convert(10)->from(Mass::Kilogram)->to(Mass::Pound);

        $this->assertInstanceOf(ConversionResult::class, $result);
    }

    // --- Linear Conversions (Mass) ---

    public function testKgToPound(): void
    {
        $result = Converter::convert(1)->from(Mass::Kilogram)->to(Mass::Pound);

        // 1 / 0.45359237 = 2.20462262...
        $this->assertEqualsWithDelta(2.20462262, $result->toFloat(), 0.0001);
    }

    public function testPoundToKg(): void
    {
        $result = Converter::convert(1)->from(Mass::Pound)->to(Mass::Kilogram);

        $this->assertEqualsWithDelta(0.45359237, $result->toFloat(), 0.0001);
    }

    public function testGramToOunce(): void
    {
        $result = Converter::convert(100)->from(Mass::Gram)->to(Mass::Ounce);

        // 100g = 3.527396...oz
        $this->assertEqualsWithDelta(3.527396, $result->toFloat(), 0.001);
    }

    public function testSameUnitReturnsSameValue(): void
    {
        $result = Converter::convert(42)->from(Mass::Kilogram)->to(Mass::Kilogram);

        $this->assertEqualsWithDelta(42.0, $result->toFloat(), 0.0001);
    }

    public function testZeroValue(): void
    {
        $result = Converter::convert(0)->from(Mass::Kilogram)->to(Mass::Pound);

        $this->assertEqualsWithDelta(0.0, $result->toFloat(), 0.0001);
    }

    public function testNegativeValue(): void
    {
        $result = Converter::convert(-10)->from(Mass::Kilogram)->to(Mass::Gram);

        $this->assertEqualsWithDelta(-10000.0, $result->toFloat(), 0.001);
    }

    // --- Temperature Conversions (non-linear) ---

    public function testCelsiusToFahrenheit(): void
    {
        $result = Converter::convert(100)->from(Temperature::Celsius)->to(Temperature::Fahrenheit);

        $this->assertEqualsWithDelta(212.0, $result->toFloat(), 0.01);
    }

    public function testFahrenheitToCelsius(): void
    {
        $result = Converter::convert(32)->from(Temperature::Fahrenheit)->to(Temperature::Celsius);

        $this->assertEqualsWithDelta(0.0, $result->toFloat(), 0.01);
    }

    public function testCelsiusToKelvin(): void
    {
        $result = Converter::convert(0)->from(Temperature::Celsius)->to(Temperature::Kelvin);

        $this->assertEqualsWithDelta(273.15, $result->toFloat(), 0.01);
    }

    public function testKelvinToCelsius(): void
    {
        $result = Converter::convert(373.15)->from(Temperature::Kelvin)->to(Temperature::Celsius);

        $this->assertEqualsWithDelta(100.0, $result->toFloat(), 0.01);
    }

    public function testFahrenheitToKelvin(): void
    {
        $result = Converter::convert(212)->from(Temperature::Fahrenheit)->to(Temperature::Kelvin);

        $this->assertEqualsWithDelta(373.15, $result->toFloat(), 0.01);
    }

    // --- Round-trip accuracy ---

    public function testRoundTripMass(): void
    {
        $original = 123.456;
        $intermediate = Converter::convert($original)->from(Mass::Kilogram)->to(Mass::Pound);
        $roundTrip = Converter::convert($intermediate->toFloat())->from(Mass::Pound)->to(Mass::Kilogram);

        $this->assertEqualsWithDelta($original, $roundTrip->toFloat(), 0.0000001);
    }

    public function testRoundTripTemperature(): void
    {
        $original = 37.5;
        $intermediate = Converter::convert($original)->from(Temperature::Celsius)->to(Temperature::Fahrenheit);
        $roundTrip = Converter::convert($intermediate->toFloat())->from(Temperature::Fahrenheit)->to(Temperature::Celsius);

        $this->assertEqualsWithDelta($original, $roundTrip->toFloat(), 0.001);
    }

    // --- String-based resolution ---

    public function testFromStringUncefactCode(): void
    {
        $result = Converter::convert(1)->from('KGM')->to('LBR');

        $this->assertEqualsWithDelta(2.20462262, $result->toFloat(), 0.0001);
    }

    public function testFromStringSymbol(): void
    {
        $result = Converter::convert(1)->from('kg')->to('lb');

        $this->assertEqualsWithDelta(2.20462262, $result->toFloat(), 0.0001);
    }

    public function testFromStringLabel(): void
    {
        $result = Converter::convert(1)->from('kilogram')->to('pound');

        $this->assertEqualsWithDelta(2.20462262, $result->toFloat(), 0.0001);
    }

    // --- Error cases ---

    public function testIncompatibleUnitsThrows(): void
    {
        $this->expectException(IncompatibleUnitsException::class);

        Converter::convert(1)->from(Mass::Kilogram)->to(Temperature::Celsius);
    }

    // --- toAll ---

    public function testToAllReturnsArray(): void
    {
        $results = Converter::convert(1)->from(Mass::Kilogram)->toAll();

        $this->assertIsArray($results);
        $this->assertArrayHasKey('GRM', $results);
        $this->assertArrayHasKey('LBR', $results);
        $this->assertEqualsWithDelta(1000, (float) $results['GRM'], 0.001);
    }

    // --- Precision ---

    public function testResultRound(): void
    {
        $result = Converter::convert(1)->from(Mass::Kilogram)->to(Mass::Pound);
        $rounded = $result->round(2);

        $this->assertSame('2.20', $rounded);
    }

    // --- unit() ---

    public function testUnitResolvesFromSymbol(): void
    {
        $unit = Converter::unit('kg');

        $this->assertSame(Mass::Kilogram, $unit);
        $this->assertSame('KGM', $unit->code());
    }

    public function testUnitResolvesFromCode(): void
    {
        $unit = Converter::unit('KGM');

        $this->assertSame(Mass::Kilogram, $unit);
        $this->assertSame('kg', $unit->symbol());
    }

    public function testUnitResolvesFromLabel(): void
    {
        $unit = Converter::unit('kilogram');

        $this->assertSame(Mass::Kilogram, $unit);
    }

    public function testUnitThrowsForUnknownInput(): void
    {
        $this->expectException(UnitNotFoundException::class);

        Converter::unit('not_a_real_unit');
    }
}
