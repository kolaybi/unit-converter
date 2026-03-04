<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Integration;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\Exceptions\IncompatibleUnitsException;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;
use KolayBi\UnitConverter\Units\Length;
use KolayBi\UnitConverter\Units\Mass;
use KolayBi\UnitConverter\Units\Packaging;
use KolayBi\UnitConverter\Units\Pressure;
use KolayBi\UnitConverter\Units\Temperature;
use KolayBi\UnitConverter\Units\Time;
use KolayBi\UnitConverter\Units\Volume;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ConversionAccuracyTest extends TestCase
{
    // --- Known reference conversions (verified against GS1 converter) ---

    #[DataProvider('knownConversionsProvider')]
    public function testKnownConversions(
        mixed $from,
        mixed $to,
        float $input,
        float $expected,
        float $delta,
    ): void {
        $result = Converter::convert($input)->from($from)->to($to);

        $this->assertEqualsWithDelta($expected, $result->toFloat(), $delta);
    }

    /**
     * @return iterable<string, array{mixed, mixed, float, float, float}>
     */
    public static function knownConversionsProvider(): iterable
    {
        // Length
        yield 'meter to foot' => [Length::Metre, Length::Foot, 1.0, 3.28084, 0.0001];
        yield 'km to mile' => [Length::Kilometre, Length::MileStatuteMile, 1.0, 0.621371, 0.0001];
        yield 'inch to cm' => [Length::Inch, Length::Centimetre, 1.0, 2.54, 0.001];

        // Mass
        yield 'kg to lb' => [Mass::Kilogram, Mass::Pound, 1.0, 2.20462, 0.0001];
        yield 'oz to g' => [Mass::Ounce, Mass::Gram, 1.0, 28.34952, 0.001];
        yield 'tonne to kg' => [Mass::TonneMetricTon, Mass::Kilogram, 1.0, 1000.0, 0.001];

        // Temperature
        yield '0°C to °F' => [Temperature::Celsius, Temperature::Fahrenheit, 0.0, 32.0, 0.01];
        yield '100°C to °F' => [Temperature::Celsius, Temperature::Fahrenheit, 100.0, 212.0, 0.01];
        yield '-40°C to °F' => [Temperature::Celsius, Temperature::Fahrenheit, -40.0, -40.0, 0.01];
        yield '0°C to K' => [Temperature::Celsius, Temperature::Kelvin, 0.0, 273.15, 0.01];
        yield '0K to °C' => [Temperature::Kelvin, Temperature::Celsius, 0.0, -273.15, 0.01];

        // Time
        yield 'hour to second' => [Time::Hour, Time::Second, 1.0, 3600.0, 0.01];
        yield 'day to hour' => [Time::Day, Time::Hour, 1.0, 24.0, 0.01];
        yield 'week to day' => [Time::Week, Time::Day, 1.0, 7.0, 0.01];

        // Pressure
        yield 'bar to pascal' => [Pressure::Bar, Pressure::Pascal, 1.0, 100000.0, 0.1];
        yield 'atm to pascal' => [Pressure::StandardAtmosphere, Pressure::Pascal, 1.0, 101325.0, 0.1];

        // Volume
        yield 'litre to ml' => [Volume::Litre, Volume::Millilitre, 1.0, 1000.0, 0.01];
        yield 'gallon UK to litre' => [Volume::GallonUK, Volume::Litre, 1.0, 4.546092, 0.001];
    }

    // --- String-based conversions ---

    public function testStringAliasesAcrossCategories(): void
    {
        $result1 = Converter::convert(1)->from('KGM')->to('GRM');
        $result2 = Converter::convert(1)->from('kg')->to('g');
        $result3 = Converter::convert(1)->from('kilogram')->to('gram');

        $this->assertSame($result1->value, $result2->value);
        $this->assertSame($result2->value, $result3->value);
    }

    // --- Error cases ---

    public function testCrossCategoryConversionThrows(): void
    {
        $this->expectException(IncompatibleUnitsException::class);

        Converter::convert(1)->from(Mass::Kilogram)->to(Length::Metre);
    }

    public function testPackagingUnitConversionThrows(): void
    {
        $this->expectException(NonConvertibleUnitException::class);

        Converter::convert(1)->from(Packaging::Box)->to(Packaging::Bag);
    }

    // --- Round-trip accuracy across categories ---

    #[DataProvider('roundTripProvider')]
    public function testRoundTripAccuracy(mixed $unitA, mixed $unitB, float $value): void
    {
        $forward = Converter::convert($value)->from($unitA)->to($unitB);
        $back = Converter::convert($forward->toFloat())->from($unitB)->to($unitA);

        $this->assertEqualsWithDelta(
            $value,
            $back->toFloat(),
            0.0001,
            "Round-trip {$unitA->name} -> {$unitB->name} -> {$unitA->name} failed",
        );
    }

    /**
     * @return iterable<string, array{mixed, mixed, float}>
     */
    public static function roundTripProvider(): iterable
    {
        yield 'mass: kg-lb' => [Mass::Kilogram, Mass::Pound, 73.5];
        yield 'temp: C-F' => [Temperature::Celsius, Temperature::Fahrenheit, 37.5];
        yield 'temp: C-K' => [Temperature::Celsius, Temperature::Kelvin, -20.0];
    }
}
