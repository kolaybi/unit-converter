<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Integration;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\Exceptions\IncompatibleUnitsException;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;
use KolayBi\UnitConverter\Units\AbsorbedDose;
use KolayBi\UnitConverter\Units\AbsorbedDoseRate;
use KolayBi\UnitConverter\Units\Acceleration;
use KolayBi\UnitConverter\Units\AmountOfSubstance;
use KolayBi\UnitConverter\Units\Angle;
use KolayBi\UnitConverter\Units\AngularImpulse;
use KolayBi\UnitConverter\Units\AngularVelocity;
use KolayBi\UnitConverter\Units\Area;
use KolayBi\UnitConverter\Units\Capacitance;
use KolayBi\UnitConverter\Units\Charge;
use KolayBi\UnitConverter\Units\Conductance;
use KolayBi\UnitConverter\Units\Current;
use KolayBi\UnitConverter\Units\Density;
use KolayBi\UnitConverter\Units\DimensionlessConcentration;
use KolayBi\UnitConverter\Units\DynamicViscosity;
use KolayBi\UnitConverter\Units\EffectiveDose;
use KolayBi\UnitConverter\Units\EffectiveDoseRate;
use KolayBi\UnitConverter\Units\Energy;
use KolayBi\UnitConverter\Units\EnergyDensity;
use KolayBi\UnitConverter\Units\Exposure;
use KolayBi\UnitConverter\Units\FlowRate;
use KolayBi\UnitConverter\Units\Force;
use KolayBi\UnitConverter\Units\Frequency;
use KolayBi\UnitConverter\Units\Illuminance;
use KolayBi\UnitConverter\Units\Impulse;
use KolayBi\UnitConverter\Units\Inductance;
use KolayBi\UnitConverter\Units\Irradiance;
use KolayBi\UnitConverter\Units\KinematicViscosity;
use KolayBi\UnitConverter\Units\Length;
use KolayBi\UnitConverter\Units\LuminousIntensity;
use KolayBi\UnitConverter\Units\MagneticFlux;
use KolayBi\UnitConverter\Units\MagneticFluxDensity;
use KolayBi\UnitConverter\Units\MagneticVectorPotential;
use KolayBi\UnitConverter\Units\Mass;
use KolayBi\UnitConverter\Units\MolarConcentration;
use KolayBi\UnitConverter\Units\MolarMass;
use KolayBi\UnitConverter\Units\MolarThermodynamicEnergy;
use KolayBi\UnitConverter\Units\MolarVolume;
use KolayBi\UnitConverter\Units\Packaging;
use KolayBi\UnitConverter\Units\Power;
use KolayBi\UnitConverter\Units\Pressure;
use KolayBi\UnitConverter\Units\Radioactivity;
use KolayBi\UnitConverter\Units\Resistance;
use KolayBi\UnitConverter\Units\SpecificVolume;
use KolayBi\UnitConverter\Units\Speed;
use KolayBi\UnitConverter\Units\Temperature;
use KolayBi\UnitConverter\Units\Time;
use KolayBi\UnitConverter\Units\Torque;
use KolayBi\UnitConverter\Units\Voltage;
use KolayBi\UnitConverter\Units\Volume;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Conversion accuracy tests verified against UN/CEFACT Rec 20 (Rev 17, 2021).
 *
 * This test suite verifies multiplier values for 643 units across 49 categories
 * by cross-referencing with Rec 20 Annex I conversion factors.
 *
 * GS1 data errors found and corrected during this verification:
 *   - HN  (mmHg):      13332.24   → 133.3224    (100x, Rec20: '133,322 4 Pa')
 *   - F79 (inHg):      33220.4859 → 3386.389    (~9.81x, Rec20: '3,386 39 × 10³ Pa')
 *   - F78 (inH₂O):     2443.56309 → 249.089     (~9.81x, Rec20: '2,490 89 × 10² Pa')
 *   - 4T  (picofarad): 1e-09      → 1e-12       (1000x, Rec20: '10⁻¹² F')
 *
 * 13 Rec 20 entries excluded (different base unit conventions, code collisions,
 * or known Rec 20 typographical errors):
 *   80, A85, B29, B71, B84, BQL, E41, H67, L21, MIK, N22, RPM, RPS
 */
final class ConversionAccuracyTest extends TestCase
{
    // ==================================================================================
    // Rec 20 Multiplier Verification (643 units)
    // ==================================================================================

    #[DataProvider('rec20MultiplierProvider')]
    public function testRec20Multiplier(
        Unit $unit,
        string $rec20ConversionFactor,
        float $expectedMultiplier,
    ): void {
        $actual = (float) $unit->multiplier();
        $tolerance = abs($expectedMultiplier) * 0.005; // 0.5% relative tolerance

        if ($tolerance < 1e-25) {
            $tolerance = 1e-25;
        }

        $this->assertEqualsWithDelta(
            $expectedMultiplier,
            $actual,
            $tolerance,
            sprintf(
                'Multiplier mismatch for %s (%s): expected=%s, actual=%s, Rec20 CF="%s"',
                $unit->code(),
                $unit->label(),
                $expectedMultiplier,
                $actual,
                $rec20ConversionFactor,
            ),
        );
    }

    /**
     * Comprehensive multiplier verification against UN/CEFACT Rec 20 (Rev 17, 2021).
     *
     * Each entry: [Unit enum case, Rec 20 conversion factor text, expected multiplier]
     *
     * @return iterable<string, array{Unit, string, float}>
     */
    public static function rec20MultiplierProvider(): iterable
    {
        // ── Absorbed Dose ────────────────────────────────────────────────────────

        yield 'A61 erg per gram' => [AbsorbedDose::ErgPerGram, '10⁻⁴ J/kg', 0.0001];
        yield 'C13 milligray' => [AbsorbedDose::Milligray, '10⁻³ Gy', 0.001];
        yield 'C80 rad' => [AbsorbedDose::Rad, '10⁻² Gy', 0.01];
        yield 'A95 gray' => [AbsorbedDose::Gray, 'm²/s²', 1.0];

        // ── Absorbed Dose Rate ───────────────────────────────────────────────────

        yield 'P54 miligray per second' => [AbsorbedDoseRate::MiligrayPerSecond, '10⁻³ Gy/s', 0.001];
        yield 'P55 microgray per second' => [AbsorbedDoseRate::MicrograyPerSecond, '10⁻⁶ Gy/s', 1e-06];
        yield 'P56 nanogray per second' => [AbsorbedDoseRate::NanograyPerSecond, '10⁻⁹ Gy/s', 1e-09];
        yield 'P57 gray per minute' => [AbsorbedDoseRate::GrayPerMinute, '1,666 67 × 10⁻² Gy/s', 0.0166667];
        yield 'P58 milligray per minute' => [AbsorbedDoseRate::MilligrayPerMinute, '1,666 67 × 10⁻⁵ Gy/s', 1.66667e-05];
        yield 'P59 microgray per minute' => [AbsorbedDoseRate::MicrograyPerMinute, '1,666 67 × 10⁻⁸ Gy/s', 1.66667e-08];
        yield 'P60 nanogray per minute' => [AbsorbedDoseRate::NanograyPerMinute, '1,666 67 × 10⁻¹¹ Gy/s', 1.66667e-11];
        yield 'P61 gray per hour' => [AbsorbedDoseRate::GrayPerHour, '2,777 78 × 10⁻⁴ Gy/s', 0.000277778];
        yield 'P62 milligray per hour' => [AbsorbedDoseRate::MilligrayPerHour, '2,777 78 × 10⁻⁷ Gy/s', 2.77778e-07];
        yield 'P63 microgray per hour' => [AbsorbedDoseRate::MicrograyPerHour, '2,777 78 × 10⁻¹⁰ Gy/s', 2.77778e-10];
        yield 'P64 nanogray per hour' => [AbsorbedDoseRate::NanograyPerHour, '2,777 78 × 10⁻¹³ Gy/s', 2.77778e-13];

        // ── Acceleration ─────────────────────────────────────────────────────────

        yield 'A73 foot per second squared' => [Acceleration::FootPerSecondSquared, '0,304 8 m/s²', 0.3048];
        yield 'A76 gal' => [Acceleration::Gal, '10⁻² m/s²', 0.01];
        yield 'C11 milligal' => [Acceleration::Milligal, '10⁻⁵ m/s²', 1e-05];
        yield 'IV inch per second squared' => [Acceleration::InchPerSecondSquared, '0,025 4 m/s²', 0.0254];
        yield 'K40 standard acceleration of free fall' => [Acceleration::StandardAccelerationOfFreeFall, '9,806 65 m/s²', 9.80665];
        yield 'M38 kilometre per second squared' => [Acceleration::KilometrePerSecondSquared, '10³ m/s²', 1000.0];
        yield 'M39 centimetre per second squared' => [Acceleration::CentimetrePerSecondSquared, '10⁻² m/s²', 0.01];
        yield 'M40 yard per second squared' => [Acceleration::YardPerSecondSquared, '9,144 x 10⁻¹ m/s²', 0.9144];
        yield 'M41 millimetre per second squared' => [Acceleration::MillimetrePerSecondSquared, '10⁻³ m/s²', 0.001];
        yield 'M42 mile (statute mile) per second squared' => [Acceleration::MileStatuteMilePerSecondSquared, '1,609 344 x 10³ m/s²', 1609.344];
        yield 'MSK metre per second squared' => [Acceleration::MetrePerSecondSquared, 'm/s²', 1.0];

        // ── Amount of Substance ──────────────────────────────────────────────────

        yield 'B45 kilomole' => [AmountOfSubstance::Kilomole, '10³ mol', 1000.0];
        yield 'C18 millimole' => [AmountOfSubstance::Millimole, '10⁻³ mol', 0.001];
        yield 'FH micromole' => [AmountOfSubstance::Micromole, '10⁻⁶ mol', 1e-06];
        yield 'C34 mole' => [AmountOfSubstance::Mole, 'mol', 1.0];

        // ── Angle ────────────────────────────────────────────────────────────────

        yield 'A91 gon' => [Angle::Gon, '1,570 796 × 10⁻² rad', 0.01570796327];
        yield 'B97 microradian' => [Angle::Microradian, '10⁻⁶ rad', 1e-06];
        yield 'C25 milliradian' => [Angle::Milliradian, '10⁻³ rad', 0.001];
        yield 'D61 minute' => [Angle::Minute, '2,908 882 × 10⁻⁴ rad', 0.0002908882087];
        yield 'D62 second' => [Angle::Second, '4,848 137 × 10⁻⁶ rad', 4.848136811e-06];
        yield 'DD degree' => [Angle::Degree, '1,745 329 x 10⁻² rad', 0.01745329252];
        yield 'M43 mil' => [Angle::Mil, '9,817 477  × 10⁻⁴ rad', 0.0009817477042];
        yield 'M44 revolution' => [Angle::Revolution, '6,283 185 rad', 6.283185307];
        yield 'C81 radian' => [Angle::Radian, 'rad', 1.0];

        // ── Angular Impulse ──────────────────────────────────────────────────────

        yield 'B33 kilogram metre squared per second' => [AngularImpulse::KilogramMetreSquaredPerSecond, 'kg x m²/s', 1.0];
        yield 'C53 newton metre second' => [AngularImpulse::NewtonMetreSecond, 'N x m x s', 1.0];

        // ── Angular Velocity ─────────────────────────────────────────────────────

        yield 'M46 revolutions per minute' => [AngularVelocity::RevolutionsPerMinute, '0,104 719 8 rad/s', 0.104719755];
        yield '2A radians per second' => [AngularVelocity::RadiansPerSecond, 'rad/s', 1.0];

        // ── Area ─────────────────────────────────────────────────────────────────

        yield 'ACR acre' => [Area::Acre, '4 046,873 m²', 4046.873];
        yield 'ARE are' => [Area::Are, '10² m²', 100.0];
        yield 'CMK square centimetre' => [Area::SquareCentimetre, '10⁻⁴ m²', 0.0001];
        yield 'DAA decare' => [Area::Decare, '10³ m²', 1000.0];
        yield 'DMK square decimetre' => [Area::SquareDecimetre, '10⁻² m²', 0.01];
        yield 'FTK square foot' => [Area::SquareFoot, '9,290 304 x 10⁻² m²', 0.09290304];
        yield 'H16 square decametre' => [Area::SquareDecametre, '10² m²', 100.0];
        yield 'H18 square hectometre' => [Area::SquareHectometre, '10⁴ m²', 10000.0];
        yield 'H30 square micrometre (square micron)' => [Area::SquareMicrometreSquareMicron, '10⁻¹² m²', 1e-12];
        yield 'HAR hectare' => [Area::Hectare, '10⁴ m²', 10000.0];
        yield 'INK square inch' => [Area::SquareInch, '6,451 6 x 10⁻⁴ m²', 0.00064516];
        yield 'KMK square kilometre' => [Area::SquareKilometre, '10⁶ m²', 1000000.0];
        yield 'M47 circular mil' => [Area::CircularMil, '5,067 075 x 10⁻¹⁰ m²', 5.067075e-10];
        yield 'M48 square mile (based on U.S. survey foot) ' => [Area::SquareMileBasedOnUsSurveyFoot, '2,589 998 x 10⁶ m²', 2589998.0];
        yield 'MMK square millimetre' => [Area::SquareMillimetre, '10⁻⁶ m²', 1e-06];
        yield 'YDK square yard' => [Area::SquareYard, '8,361 274 x 10⁻¹ m²', 0.8361274];
        yield 'MTK square metre' => [Area::SquareMetre, 'm²', 1.0];

        // ── Capacitance ──────────────────────────────────────────────────────────

        yield '4O microfarad' => [Capacitance::Microfarad, '10⁻⁶ F', 1e-06];
        yield '4T picofarad' => [Capacitance::Picofarad, '10⁻¹² F', 1e-12];
        yield 'C10 millifarad' => [Capacitance::Millifarad, '10⁻³ F', 0.001];
        yield 'C41 nanofarad' => [Capacitance::Nanofarad, '10⁻⁹ F', 1e-09];
        yield 'H48 attofarad' => [Capacitance::Attofarad, '10⁻¹⁸ m⁻² x kg⁻¹ x s⁴ x A²', 1e-18];
        yield 'N90 kilofarad' => [Capacitance::Kilofarad, '10³ F', 1000.0];
        yield 'FAR farad' => [Capacitance::Farad, 'F', 1.0];

        // ── Charge ───────────────────────────────────────────────────────────────

        yield 'AMH ampere hour' => [Charge::AmpereHour, '3,6 x 10³ C', 3600.0];
        yield 'B26 kilocoulomb' => [Charge::Kilocoulomb, '10³ C', 1000.0];
        yield 'B86 microcoulomb' => [Charge::Microcoulomb, '10⁻⁶ C', 1e-06];
        yield 'C40 nanocoulomb' => [Charge::Nanocoulomb, '10⁻⁹ C', 1e-09];
        yield 'C71 picocoulomb' => [Charge::Picocoulomb, '10⁻¹² C', 1e-12];
        yield 'D77 megacoulomb' => [Charge::Megacoulomb, '10⁶ C', 1000000.0];
        yield 'D86 millicoulomb' => [Charge::Millicoulomb, '10⁻³ C', 0.001];
        yield 'E09 milliampere hour' => [Charge::MilliampereHour, '3,6 C', 3.6];
        yield 'N94 franklin' => [Charge::Franklin, '3,335 641 x 10⁻¹⁰ C', 3.335641e-10];
        yield 'N95 ampere minute' => [Charge::AmpereMinute, '60 C', 60.0];
        yield 'TAH kiloampere hour (thousand ampere hour)' => [Charge::KiloampereHourThousandAmpereHour, '3,6 x 10⁶ C', 3600000.0];
        yield 'A8 ampere second' => [Charge::AmpereSecond, 'C', 1.0];
        yield 'COU coulomb' => [Charge::Coulomb, 'A x s', 1.0];

        // ── Conductance ──────────────────────────────────────────────────────────

        yield 'B53 kilosiemens' => [Conductance::Kilosiemens, '10³ S', 1000.0];
        yield 'B99 microsiemens' => [Conductance::Microsiemens, '10⁻⁶ S', 1e-06];
        yield 'C27 millisiemens' => [Conductance::Millisiemens, '10⁻³ S', 0.001];
        yield 'N92 picosiemens' => [Conductance::Picosiemens, '10⁻¹² S', 1e-12];
        yield 'NR micromho' => [Conductance::Micromho, '10⁻⁶ S', 1e-06];
        yield 'NQ mho' => [Conductance::Mho, 'S', 1.0];
        yield 'SIE siemens' => [Conductance::Siemens, 'A/V', 1.0];

        // ── Current ──────────────────────────────────────────────────────────────

        yield '4K milliampere' => [Current::Milliampere, '10⁻³ A', 0.001];
        yield 'B22 kiloampere' => [Current::Kiloampere, '10³ A', 1000.0];
        yield 'C39 nanoampere' => [Current::Nanoampere, '10⁻⁹ A', 1e-09];
        yield 'C70 picoampere' => [Current::Picoampere, '10⁻¹² A', 1e-12];
        yield 'H38 megaampere' => [Current::Megaampere, '10⁶ A', 1000000.0];
        yield 'N96 biot' => [Current::Biot, '10¹ A', 10.0];
        yield 'N97 gilbert' => [Current::Gilbert, '7,957 747 x 10⁻¹ A', 0.7957747];
        yield 'AMP ampere' => [Current::Ampere, 'A', 1.0];

        // ── Density ──────────────────────────────────────────────────────────────

        yield '23 gram per cubic centimetre' => [Density::GramPerCubicCentimetre, '10³ kg/m³', 1000.0];
        yield '87 pound per cubic foot' => [Density::PoundPerCubicFoot, '1,601 846 x 10¹ kg/m³', 16.01846];
        yield 'A93 gram per cubic metre' => [Density::GramPerCubicMetre, '10⁻³ kg/m³', 0.001];
        yield 'B34 kilogram per cubic decimetre' => [Density::KilogramPerCubicDecimetre, '10³ kg/m³', 1000.0];
        yield 'B35 kilogram per litre' => [Density::KilogramPerLitre, '10³ kg/m³', 1000.0];
        yield 'B72 megagram per cubic metre' => [Density::MegagramPerCubicMetre, '10³ kg/m³', 1000.0];
        yield 'D41 tonne per cubic metre' => [Density::TonnePerCubicMetre, '10³ kg/m³', 1000.0];
        yield 'G31 kilogram per cubic centimetre' => [Density::KilogramPerCubicCentimetre, '10⁶ kg x m⁻³', 1000000.0];
        yield 'G32 ounce (avoirdupois) per cubic yard' => [Density::OunceAvoirdupoisPerCubicYard, '3,707 98 × 10⁻² kg x m⁻³', 0.0370798];
        yield 'GE pound per gallon (US)' => [Density::PoundPerGallonUS, '1,198 264 x 10² kg/m³', 119.8264];
        yield 'GJ gram per millilitre' => [Density::GramPerMillilitre, '10³ kg/m³', 1000.0];
        yield 'GP milligram per cubic metre' => [Density::MilligramPerCubicMetre, '10⁻⁶ kg/m³', 1e-06];
        yield 'GQ microgram per cubic metre' => [Density::MicrogramPerCubicMetre, '10⁻⁹ kg/m³', 1e-09];
        yield 'H29 microgram per litre' => [Density::MicrogramPerLitre, '10⁻⁶ m⁻³ x kg', 1e-06];
        yield 'K41 grain per gallon (US)' => [Density::GrainPerGallonUS, '1,711 806 x 10⁻² kg/m³', 0.01711806];
        yield 'K71 pound (avoirdupois) per gallon (UK)' => [Density::PoundAvoirdupoisPerGallonUK, '99,776 37 kg/m³', 99.77637];
        yield 'K84 pound per cubic yard' => [Density::PoundPerCubicYard, '0,593 276 4 kg/m³', 0.5932764];
        yield 'L37 ounce (avoirdupois) per gallon (UK)' => [Density::OunceAvoirdupoisPerGallonUK, '6,236 023 kg/m³', 6.236023];
        yield 'L38 ounce (avoirdupois) per gallon (US)' => [Density::OunceAvoirdupoisPerGallonUS, '7,489 152 kg/m³', 7.489152];
        yield 'L39 ounce (avoirdupois) per cubic inch' => [Density::OunceAvoirdupoisPerCubicInch, '1,729 994 x 10³ kg/m³', 1729.994];
        yield 'L65 slug per cubic foot' => [Density::SlugPerCubicFoot, '5,153 788 x 10² kg/m³', 515.3788];
        yield 'L92 ton (UK long) per cubic yard' => [Density::TonUKLongPerCubicYard, '1,328 939 x 10³ kg/m³', 1328.939];
        yield 'L93 ton (US short) per cubic yard' => [Density::TonUSShortPerCubicYard, '1,186 553 x 10³ kg/m³', 1186.553];
        yield 'LA pound per cubic inch' => [Density::PoundPerCubicInch, '2,767 990 x 10⁴ kg/m³', 27679.9];
        yield 'M1 milligram per litre' => [Density::MilligramPerLitre, '10⁻³ kg/m³', 0.001];
        yield 'F23 gram per cubic decimetre' => [Density::GramPerCubicDecimetre, 'kg x m⁻³', 1.0];
        yield 'GL gram per litre' => [Density::GramPerLitre, 'kg/m³', 1.0];
        yield 'KMQ kilogram per cubic metre' => [Density::KilogramPerCubicMetre, 'kg/m³', 1.0];

        // ── Dimensionless ────────────────────────────────────────────────────────

        yield 'H60 cubic metre per cubic metre' => [DimensionlessConcentration::CubicMetrePerCubicMetre, '1', 1.0];
        yield 'H65 millilitre per cubic metre' => [DimensionlessConcentration::MillilitrePerCubicMetre, '10⁻⁶ 1', 1e-06];
        yield 'J33 microgram per kilogram' => [DimensionlessConcentration::MicrogramPerKilogram, '10⁻⁹', 1e-09];
        yield 'J36 microlitre per litre' => [DimensionlessConcentration::MicrolitrePerLitre, '10⁻⁶', 1e-06];
        yield 'J87 cubic centimetre per cubic metre' => [DimensionlessConcentration::CubicCentimetrePerCubicMetre, '10⁻⁶', 1e-06];
        yield 'J91 cubic decimetre per cubic metre' => [DimensionlessConcentration::CubicDecimetrePerCubicMetre, '10⁻³', 0.001];
        yield 'K62 litre per litre' => [DimensionlessConcentration::LitrePerLitre, '1', 1.0];
        yield 'L19 millilitre per litre' => [DimensionlessConcentration::MillilitrePerLitre, '10⁻³', 0.001];
        yield 'L32 nanogram per kilogram' => [DimensionlessConcentration::NanogramPerKilogram, '10⁻¹²', 1e-12];
        yield 'M29 kilogram per kilogram' => [DimensionlessConcentration::KilogramPerKilogram, '1', 1.0];
        yield 'NA milligram per kilogram' => [DimensionlessConcentration::MilligramPerKilogram, '10⁻⁶  1', 1e-06];

        // ── Dynamic Viscosity ────────────────────────────────────────────────────

        yield '89 poise' => [DynamicViscosity::Poise, '0,1 Pa x s', 0.1];
        yield 'C24 millipascal second' => [DynamicViscosity::MillipascalSecond, '10⁻³ Pa x s', 0.001];
        yield 'C7 centipoise' => [DynamicViscosity::Centipoise, '10⁻³ Pa x s', 0.001];
        yield 'J32 micropoise' => [DynamicViscosity::Micropoise, '10⁻⁶ Pa x s', 1e-06];
        yield 'K67 pound per foot hour' => [DynamicViscosity::PoundPerFootHour, '4,133 789 x 10⁻⁴ Pa x s', 0.0004133789];
        yield 'K68 pound per foot second' => [DynamicViscosity::PoundPerFootSecond, '1,488 164 Pa x s', 1.488164];
        yield 'K91 pound-force second per square foot' => [DynamicViscosity::PoundForceSecondPerSquareFoot, '47,880 26 Pa x s', 47.88026];
        yield 'K92 pound-force second per square inch' => [DynamicViscosity::PoundForceSecondPerSquareInch, '6,894 757  x 10³ Pa x s', 6894.757];
        yield 'L64 slug per foot second' => [DynamicViscosity::SlugPerFootSecond, '47,880 26 Pa x s', 47.88026];
        yield 'N34 poundal second per square foot ' => [DynamicViscosity::PoundalSecondPerSquareFoot, '1,488 164 Pa x s', 1.488164];
        yield 'N38 kilogram per metre minute' => [DynamicViscosity::KilogramPerMetreMinute, '1,666 67 × 10⁻² Pa x s', 0.0166667];
        yield 'N39 kilogram per metre day' => [DynamicViscosity::KilogramPerMetreDay, '1,157 41 × 10⁻⁵ Pa x s', 1.15741e-05];
        yield 'N40 kilogram per metre hour' => [DynamicViscosity::KilogramPerMetreHour, '2,777 78 × 10⁻⁴ Pa x s', 0.000277778];
        yield 'N41 gram per centimetre second' => [DynamicViscosity::GramPerCentimetreSecond, '0,1 Pa x s', 0.1];
        yield 'N42 poundal second per square inch' => [DynamicViscosity::PoundalSecondPerSquareInch, '2,142 957 x 10² Pa x s', 214.2957];
        yield 'N43 pound per foot minute' => [DynamicViscosity::PoundPerFootMinute, '2,480 273 x 10⁻²  Pa x s', 0.02480273];
        yield 'N44 pound per foot day' => [DynamicViscosity::PoundPerFootDay, '1,722 412 x 10⁻⁵ Pa x s', 1.722412e-05];
        yield 'C65 pascal second' => [DynamicViscosity::PascalSecond, 'Pa x s', 1.0];
        yield 'N36 newton second per square metre' => [DynamicViscosity::NewtonSecondPerSquareMetre, 'Pa x s', 1.0];

        // ── Effective Dose ───────────────────────────────────────────────────────

        yield 'C28 millisievert' => [EffectiveDose::Millisievert, '10⁻³ Sv', 0.001];
        yield 'D91 rem' => [EffectiveDose::Rem, '10⁻² Sv', 0.01];
        yield 'L31 milliroentgen aequivalent men' => [EffectiveDose::MilliroentgenAequivalentMen, '10⁻⁵ Sv', 1e-05];
        yield 'D13 sievert' => [EffectiveDose::Sievert, 'm²/s²', 1.0];

        // ── Effective Dose Rate ──────────────────────────────────────────────────

        yield 'P66 millisievert per second' => [EffectiveDoseRate::MillisievertPerSecond, '10⁻³ Sv/s', 0.001];
        yield 'P67 microsievert per second' => [EffectiveDoseRate::MicrosievertPerSecond, '10⁻⁶ Sv/s', 1e-06];
        yield 'P68 nanosievert per second' => [EffectiveDoseRate::NanosievertPerSecond, '10⁻⁹ Sv/s', 1e-09];
        yield 'P69 rem per second' => [EffectiveDoseRate::RemPerSecond, '10⁻² Sv/s', 0.01];
        yield 'P70 sievert per hour' => [EffectiveDoseRate::SievertPerHour, '2,777 78 × 10⁻⁴ Sv/s', 0.000277778];
        yield 'P71 millisievert per hour' => [EffectiveDoseRate::MillisievertPerHour, '0,277 777 778 × 10⁻⁷ Sv/s', 2.77777778e-08];
        yield 'P72 microsievert per hour' => [EffectiveDoseRate::MicrosievertPerHour, '0,277 777 778 × 10⁻¹⁰ Sv/s', 2.77777778e-11];
        yield 'P73 nanosievert per hour' => [EffectiveDoseRate::NanosievertPerHour, '0,277 777 778 × 10⁻¹³ Sv/s', 2.77777778e-14];
        yield 'P74 sievert per minute' => [EffectiveDoseRate::SievertPerMinute, '0,016 666 Sv/s', 0.016666];
        yield 'P75 millisievert per minute' => [EffectiveDoseRate::MillisievertPerMinute, '1,666 666 667 × 10⁻⁵ Sv/s', 1.666666667e-05];
        yield 'P76 microsievert per minute' => [EffectiveDoseRate::MicrosievertPerMinute, '1,666 666 667 × 10⁻⁸ Sv/s', 1.666666667e-08];
        yield 'P77 nanosievert per minute' => [EffectiveDoseRate::NanosievertPerMinute, '1,666 666 667 × 10⁻¹¹ Sv/s', 1.666666667e-11];
        yield 'P65 sievert per second' => [EffectiveDoseRate::SievertPerSecond, 'Sv/s', 1.0];

        // ── Energy ───────────────────────────────────────────────────────────────

        yield '3B megajoule' => [Energy::Megajoule, '10⁶ J', 1000000.0];
        yield '85 foot pound-force' => [Energy::FootPoundForce, '1,355 818 J', 1.355818];
        yield 'A13 attojoule' => [Energy::Attojoule, '10⁻¹⁸ J', 1e-18];
        yield 'A53 electronvolt' => [Energy::Electronvolt, '1,602 176 487 x 10⁻¹⁹ J', 1.602176487e-19];
        yield 'A57 erg' => [Energy::Erg, '10⁻⁷J', 1e-07];
        yield 'A68 exajoule' => [Energy::Exajoule, '10¹⁸ J', 1e+18];
        yield 'A70 femtojoule' => [Energy::Femtojoule, '10⁻¹⁵ J', 1e-15];
        yield 'BTU British thermal unit (international table)' => [Energy::BritishThermalUnitInternationalTable, '1,055 056 x 10³ J', 1055.056];
        yield 'C15 millijoule' => [Energy::Millijoule, '10⁻³ J', 0.001];
        yield 'C68 petajoule' => [Energy::Petajoule, '10¹⁵ J', 1000000000000000.0];
        yield 'D30 terajoule' => [Energy::Terajoule, '10¹² J', 1000000000000.0];
        yield 'D32 terawatt hour' => [Energy::TerawattHour, '3,6 x 10¹⁵ J', 3600000000000000.0];
        yield 'E14 kilocalorie (international table)' => [Energy::KilocalorieInternationalTable, '4,186 8 x 10³ J', 4186.8];
        yield 'GV gigajoule' => [Energy::Gigajoule, '10⁹ J', 1000000000.0];
        yield 'GWH gigawatt hour' => [Energy::GigawattHour, '3,6 x 10¹² J', 3600000000000.0];
        yield 'J75 calorie (mean)' => [Energy::CalorieMean, '4,190 02 J', 4.19002];
        yield 'K51 kilocalorie (mean)' => [Energy::KilocalorieMean, '4,190 02 x 10³ J', 4190.02];
        yield 'K53 kilocalorie (thermochemical)' => [Energy::KilocalorieThermochemical, '4,184 x 10³ J', 4184.0];
        yield 'KJO kilojoule' => [Energy::Kilojoule, '10³ J', 1000.0];
        yield 'KWH kilowatt hour' => [Energy::KilowattHour, '3,6 x 10⁶ J', 3600000.0];
        yield 'MWH megawatt hour' => [Energy::MegawattHour, '3,6 x 10⁹ J', 3600000000.0];
        yield 'N46 foot poundal' => [Energy::FootPoundal, '4,214 011 x 10⁻² J', 0.04214011];
        yield 'N47 inch poundal' => [Energy::InchPoundal, '3,511 677 x 10⁻³ J', 0.003511677];
        yield 'N71 therm (EC)' => [Energy::ThermEc, '1,055 06 × 10⁸ J', 105506000.0];
        yield 'N72 therm (US)' => [Energy::ThermUS, '1,054 804 × 10⁸ J', 105480400.0];
        yield 'WHR watt hour' => [Energy::WattHour, '3,6 x 10³ J', 3600.0];
        yield 'J55 watt second' => [Energy::WattSecond, 'W x s', 1.0];
        yield 'JOU joule' => [Energy::Joule, 'J', 1.0];

        // ── Energy Density ───────────────────────────────────────────────────────

        yield 'A60 erg per cubic centimetre' => [EnergyDensity::ErgPerCubicCentimetre, '10⁻¹ J/m³', 0.1];
        yield 'JM megajoule per cubic metre' => [EnergyDensity::MegajoulePerCubicMetre, '10⁶ J/m³', 1000000.0];
        yield 'N58 British thermal unit (international table) per cubic foot ' => [EnergyDensity::BritishThermalUnitInternationalTablePerCubicFoot, '3,725 895 x10⁴ J/m³', 37258.95];
        yield 'N59 British thermal unit (thermochemical) per cubic foot' => [EnergyDensity::BritishThermalUnitThermochemicalPerCubicFoot, '3,723 403 x10⁴ J/m³', 37234.03];
        yield 'B8 joule per cubic metre' => [EnergyDensity::JoulePerCubicMetre, 'J/m³', 1.0];

        // ── Exposure ─────────────────────────────────────────────────────────────

        yield 'B63 lux hour' => [Exposure::LuxHour, '3,6 x 10³ s x cd x sr / m²', 3600.0];
        yield 'B64 lux second' => [Exposure::LuxSecond, 's x cd x sr / m²', 1.0];

        // ── Flow Rate ────────────────────────────────────────────────────────────

        yield '2J cubic centimetre per second' => [FlowRate::CubicCentimetrePerSecond, '10⁻⁶ m³/s', 1e-06];
        yield '2K cubic foot per hour' => [FlowRate::CubicFootPerHour, '7,865 79 x 10⁻⁶ m³/s', 7.86579e-06];
        yield '2L cubic foot per minute' => [FlowRate::CubicFootPerMinute, '4,719 474 x 10⁻⁴ m³/s', 0.0004719474];
        yield '40 millilitre per second' => [FlowRate::MillilitrePerSecond, '10⁻⁶ m³/s', 1e-06];
        yield '41 millilitre per minute' => [FlowRate::MillilitrePerMinute, '1,666 67 x 10⁻⁸ m³/s', 1.66667e-08];
        yield '4X kilolitre per hour' => [FlowRate::KilolitrePerHour, '2,777 78 x 10⁻⁴ m³/s', 0.000277778];
        yield '5A barrel (US) per minute' => [FlowRate::BarrelUSPerMinute, '2,649 79 x 10⁻³ m³/s', 0.00264979];
        yield 'G2 US gallon per minute' => [FlowRate::USGallonPerMinute, '6,309 020 x 10⁻⁵ m³/s', 6.30902e-05];
        yield 'G3 Imperial gallon per minute' => [FlowRate::ImperialGallonPerMinute, '7,576 82 x 10⁻⁵ m³/s', 7.57682e-05];
        yield 'J58 barrel (UK petroleum) per minute' => [FlowRate::BarrelUKPetroleumPerMinute, '2,651 886 m³/s', 2.651886];
        yield 'J59 barrel (UK petroleum) per day' => [FlowRate::BarrelUKPetroleumPerDay, '1,841 587 4 x 10⁻⁶ m³/s', 1.8415874e-06];
        yield 'J60 barrel (UK petroleum) per hour' => [FlowRate::BarrelUKPetroleumPerHour, '4,419 810 x 10⁻⁵ m³/s', 4.41981e-05];
        yield 'J61 barrel (UK petroleum) per second' => [FlowRate::BarrelUKPetroleumPerSecond, '0,159 113 15 m³/s', 0.15911315];
        yield 'J62 barrel (US petroleum) per hour' => [FlowRate::BarrelUSPetroleumPerHour, '4,416 314 x 10⁻⁵ m³/s', 4.416314e-05];
        yield 'J63 barrel (US petroleum) per second' => [FlowRate::BarrelUSPetroleumPerSecond, '0,158 987 3 m³/s', 0.1589873];
        yield 'J64 bushel (UK) per day' => [FlowRate::BushelUKPerDay, '4,209 343 x 10⁻⁷ m³/s', 4.209343e-07];
        yield 'J65 bushel (UK) per hour' => [FlowRate::BushelUKPerHour, '1,010 242 x 10⁻⁵ m³/s', 1.010242e-05];
        yield 'J66 bushel (UK) per minute' => [FlowRate::BushelUKPerMinute, '6,061 453 x 10⁻⁴ m³/s', 0.0006061453];
        yield 'J67 bushel (UK) per second' => [FlowRate::BushelUKPerSecond, '3,636 872 x 10⁻² m³/s', 0.03636872];
        yield 'J68 bushel (US dry) per day' => [FlowRate::BushelUSDryPerDay, '4,078 596 x 10⁻⁷ m³/s', 4.078596e-07];
        yield 'J69 bushel (US dry) per hour' => [FlowRate::BushelUSDryPerHour, '9,788 631 x 10⁻⁶ m³/s', 9.788631e-06];
        yield 'J70 bushel (US dry) per minute' => [FlowRate::BushelUSDryPerMinute, '5,873 178 x 10⁻⁴ m³/s', 0.0005873178];
        yield 'J71 bushel (US dry) per second' => [FlowRate::BushelUSDryPerSecond, '3,523 907 x 10⁻² m³/s', 0.03523907];
        yield 'J90 cubic decimetre per day' => [FlowRate::CubicDecimetrePerDay, '1,157 41 x 10⁻⁸ m³/s', 1.15741e-08];
        yield 'J92 cubic decimetre per minute' => [FlowRate::CubicDecimetrePerMinute, '1,666 67 x 10⁻⁵ m³/s', 1.66667e-05];
        yield 'J93 cubic decimetre per second' => [FlowRate::CubicDecimetrePerSecond, '10⁻³ m³/s', 0.001];
        yield 'J95 ounce (UK fluid) per day' => [FlowRate::OunceUKFluidPerDay, '3,288 549 x 10⁻¹⁰ m³/s', 3.288549e-10];
        yield 'J96 ounce (UK fluid) per hour' => [FlowRate::OunceUKFluidPerHour, '7,892 517 x 10⁻⁹ m³/s', 7.892517e-09];
        yield 'J97 ounce (UK fluid) per minute' => [FlowRate::OunceUKFluidPerMinute, '4,735 51 x 10⁻⁷ m³/s', 4.73551e-07];
        yield 'J98 ounce (UK fluid) per second' => [FlowRate::OunceUKFluidPerSecond, '2,841 306 x 10⁻⁵ m³/s', 2.841306e-05];
        yield 'J99 ounce (US fluid) per day' => [FlowRate::OunceUSFluidPerDay, '3,422 862 x 10⁻¹⁰ m³/s', 3.422862e-10];
        yield 'K10 ounce (US fluid) per hour' => [FlowRate::OunceUSFluidPerHour, '8,214 869 x 10⁻⁹ m³/s', 8.214869e-09];
        yield 'K11 ounce (US fluid) per minute' => [FlowRate::OunceUSFluidPerMinute, '4,928 922 x 10⁻⁷ m³/s', 4.928922e-07];
        yield 'K12 ounce (US fluid) per second' => [FlowRate::OunceUSFluidPerSecond, '2,957 353 x 10⁻⁵ m³/s', 2.957353e-05];
        yield 'K22 cubic foot per day' => [FlowRate::CubicFootPerDay, '3,277 413 x 10⁻⁷ m³/s', 3.277413e-07];
        yield 'K26 gallon (UK) per day' => [FlowRate::GallonUKPerDay, '5,261 678 x 10⁻⁸ m³/s', 5.261678e-08];
        yield 'K27 gallon (UK) per hour' => [FlowRate::GallonUKPerHour, '1,262 803 x 10⁻⁶ m³/s', 1.262803e-06];
        yield 'K28 gallon (UK) per second' => [FlowRate::GallonUKPerSecond, '4,546 09 x 10⁻³ m³/s', 0.00454609];
        yield 'K30 gallon (US liquid) per second' => [FlowRate::GallonUSLiquidPerSecond, '3,785 412 x 10⁻³ m³/s', 0.003785412];
        yield 'K32 gill (UK) per day' => [FlowRate::GillUKPerDay, '1,644 274 x 10⁻⁵ m³/s', 1.644274e-05];
        yield 'K33 gill (UK) per hour' => [FlowRate::GillUKPerHour, '3,946 258 x 10⁻⁸ m³/s', 3.946258e-08];
        yield 'K34 gill (UK) per minute' => [FlowRate::GillUKPerMinute, '0,023 677 55 m³/s', 0.02367755];
        yield 'K35 gill (UK) per second' => [FlowRate::GillUKPerSecond, '1,420 653 x 10⁻⁴ m³/s', 0.0001420653];
        yield 'K36 gill (US) per day' => [FlowRate::GillUSPerDay, '1,369 145 x 10⁻⁹ m³/s', 1.369145e-09];
        yield 'K37 gill (US) per hour' => [FlowRate::GillUSPerHour, '3,285 947 x 10⁻⁸ m³/s', 3.285947e-08];
        yield 'K38 gill (US) per minute' => [FlowRate::GillUSPerMinute, '1,971 568 x 10⁻⁶ m³/s', 1.971568e-06];
        yield 'K39 gill (US) per second' => [FlowRate::GillUSPerSecond, '1,182 941 x 10⁻⁴ m³/s', 0.0001182941];
        yield 'K94 quart (UK liquid) per day' => [FlowRate::QuartUKLiquidPerDay, '1,315 420 x 10⁻⁸ m³/s', 1.31542e-08];
        yield 'K95 quart (UK liquid) per hour' => [FlowRate::QuartUKLiquidPerHour, '3,157 008 x 10⁻⁷ m³/s', 3.157008e-07];
        yield 'K96 quart (UK liquid) per minute' => [FlowRate::QuartUKLiquidPerMinute, '1,894 205 x 10⁻⁵ m³/s', 1.894205e-05];
        yield 'K97 quart (UK liquid) per second' => [FlowRate::QuartUKLiquidPerSecond, '1,136 523 x 10⁻³ m³/s', 0.001136523];
        yield 'K98 quart (US liquid) per day' => [FlowRate::QuartUSLiquidPerDay, '1,095 316 x 10⁻⁸ m³/s', 1.095316e-08];
        yield 'K99 quart (US liquid) per hour' => [FlowRate::QuartUSLiquidPerHour, '2,628 758 x 10⁻⁷ m³/s', 2.628758e-07];
        yield 'L10 quart (US liquid) per minute' => [FlowRate::QuartUSLiquidPerMinute, '1,577 255 x 10⁻⁵ m³/s', 1.577255e-05];
        yield 'L11 quart (US liquid) per second' => [FlowRate::QuartUSLiquidPerSecond, '9,463 529 x 10⁻⁴ m³/s', 0.0009463529];
        yield 'L2 litre per minute' => [FlowRate::LitrePerMinute, '1,666 67 x 10⁻⁵ m³/s', 1.66667e-05];
        yield 'L44 peck (UK) per day' => [FlowRate::PeckUKPerDay, '1,052 336 x 10⁻⁷ m³/s', 1.052336e-07];
        yield 'L45 peck (UK) per hour' => [FlowRate::PeckUKPerHour, '2,525 606 x 10⁻⁶ m³/s', 2.525606e-06];
        yield 'L46 peck (UK) per minute' => [FlowRate::PeckUKPerMinute, '1,515 363 5 x 10⁻⁴ m³/s', 0.00015153635];
        yield 'L47 peck (UK) per second' => [FlowRate::PeckUKPerSecond, '9,092 181 x 10⁻³ m³/s', 0.009092181];
        yield 'L48 peck (US dry) per day' => [FlowRate::PeckUSDryPerDay, '1,019 649 x 10⁻⁷ m³/s', 1.019649e-07];
        yield 'L49 peck (US dry) per hour' => [FlowRate::PeckUSDryPerHour, '2,447 158 x 10⁻⁶ m³/s', 2.447158e-06];
        yield 'L50 peck (US dry) per minute' => [FlowRate::PeckUSDryPerMinute, '1,468 295 x 10⁻⁴ m³/s', 0.0001468295];
        yield 'L51 peck (US dry) per second' => [FlowRate::PeckUSDryPerSecond, '8,809 768 x 10⁻³ m³/s', 0.008809768];
        yield 'L53 pint (UK) per day' => [FlowRate::PintUKPerDay, '6,577 098 x 10⁻⁹ m³/s', 6.577098e-09];
        yield 'L54 pint (UK) per hour' => [FlowRate::PintUKPerHour, '1,578 504 x 10⁻⁷ m³/s', 1.578504e-07];
        yield 'L55 pint (UK) per minute' => [FlowRate::PintUKPerMinute, '9,471 022 x 10⁻⁶ m³/s', 9.471022e-06];
        yield 'L56 pint (UK) per second' => [FlowRate::PintUKPerSecond, '5,682 613 x 10⁻⁴ m³/s', 0.0005682613];
        yield 'L57 pint (US liquid) per day' => [FlowRate::PintUSLiquidPerDay, '5,476 580 x 10⁻⁹ m³/s', 5.47658e-09];
        yield 'L58 pint (US liquid) per hour' => [FlowRate::PintUSLiquidPerHour, '1,314 379 x 10⁻⁷ m³/s', 1.314379e-07];
        yield 'L59 pint (US liquid) per minute' => [FlowRate::PintUSLiquidPerMinute, '7,886 275 x 10⁻⁶ m³/s', 7.886275e-06];
        yield 'L60 pint (US liquid) per second' => [FlowRate::PintUSLiquidPerSecond, '4,731 765 x 10⁻⁴ m³/s', 0.0004731765];
        yield 'LD litre per day' => [FlowRate::LitrePerDay, '1,157 41 x 10⁻⁸ m³/s', 1.15741e-08];
        yield 'M12 cubic yard per day' => [FlowRate::CubicYardPerDay, '8,849 015 x 10⁻⁶ m³/s', 8.849015e-06];
        yield 'M13 cubic yard per hour' => [FlowRate::CubicYardPerHour, '2,123 764 x 10⁻⁴ m³/s', 0.0002123764];
        yield 'M15 cubic yard per minute' => [FlowRate::CubicYardPerMinute, '1,274 258 x 10⁻² m³/s', 0.01274258];
        yield 'M16 cubic yard per second' => [FlowRate::CubicYardPerSecond, '0,764 554 9 m³/s', 0.7645549];
        yield 'MQH cubic metre per hour' => [FlowRate::CubicMetrePerHour, '2,777 78 x 10⁻⁴ m³/s', 0.000277778];
        yield 'Q37 Standard cubic metre per day' => [FlowRate::StandardCubicMetrePerDay, '1.15741 × 10-5 m3/s', 1.15741e-05];
        yield 'Q38 Standard cubic metre per hour' => [FlowRate::StandardCubicMetrePerHour, '2.77778 × 10-4 m3/s', 0.000277778];
        yield 'Q39 Normalized cubic metre per day' => [FlowRate::NormalizedCubicMetrePerDay, '1.15741 × 10-5 m3/s', 1.15741e-05];
        yield 'Q40 Normalized cubic metre per hour' => [FlowRate::NormalizedCubicMetrePerHour, '2.77778 × 10-4 m3/s', 0.000277778];
        yield 'MQS cubic metre per second' => [FlowRate::CubicMetrePerSecond, 'm³/s', 1.0];

        // ── Force ────────────────────────────────────────────────────────────────

        yield 'B37 kilogram-force' => [Force::KilogramForce, '9,806 65 N', 9.80665];
        yield 'B47 kilonewton' => [Force::Kilonewton, '10³ N', 1000.0];
        yield 'B51 kilopond' => [Force::Kilopond, '9,806 65 N', 9.80665];
        yield 'B73 meganewton' => [Force::Meganewton, '10⁶ N', 1000000.0];
        yield 'B92 micronewton' => [Force::Micronewton, '10⁻⁶ N', 1e-06];
        yield 'C20 millinewton' => [Force::Millinewton, '10⁻³ N', 0.001];
        yield 'C78 pound-force' => [Force::PoundForce, '4,448 222 N', 4.448222];
        yield 'DU dyne' => [Force::Dyne, '10⁻⁵ N', 1e-05];
        yield 'L40 ounce (avoirdupois)-force' => [Force::OunceAvoirdupoisForce, '0,278 013 9 N', 0.2780139];
        yield 'L94 ton-force (US short)' => [Force::TonForceUSShort, '8,896 443 x 10³ N', 8896.443];
        yield 'M75 kilopound-force' => [Force::KilopoundForce, '4,448 222 x 10³ N', 4448.222];
        yield 'M76 poundal' => [Force::Poundal, '1,382 550 x 10⁻¹ N', 0.138255];
        yield 'M78 pond' => [Force::Pond, '9,806 65 x 10⁻³ N', 0.00980665];
        yield 'M77 kilogram metre per second squared' => [Force::KilogramMetrePerSecondSquared, '(kg x m)/s²', 1.0];
        yield 'NEW newton' => [Force::Newton, '(kg x m)/s²', 1.0];

        // ── Frequency ────────────────────────────────────────────────────────────

        yield 'A86 gigahertz' => [Frequency::Gigahertz, '10⁹ Hz', 1000000000.0];
        yield 'C94 reciprocal minute' => [Frequency::ReciprocalMinute, '1,666 667 x 10⁻² s', 0.016666666666666666];
        yield 'D29 terahertz' => [Frequency::Terahertz, '10¹² Hz', 1000000000000.0];
        yield 'KHZ kilohertz' => [Frequency::Kilohertz, '10³ Hz', 1000.0];
        yield 'MHZ megahertz' => [Frequency::Megahertz, '10⁶ Hz', 1000000.0];
        yield 'C97 reciprocal second' => [Frequency::ReciprocalSecond, 's⁻¹', 1.0];
        yield 'HTZ hertz' => [Frequency::Hertz, 'Hz', 1.0];

        // ── Illuminance ──────────────────────────────────────────────────────────

        yield 'KLX kilolux' => [Illuminance::Kilolux, '10³ cd x sr / m²', 1000.0];
        yield 'P25 lumen per square foot ' => [Illuminance::LumenPerSquareFoot, '1,076 391 x 10¹ cd x sr / m²', 10.76391];
        yield 'P26 phot' => [Illuminance::Phot, '10⁴ cd x sr / m²', 10000.0];
        yield 'P27 footcandle' => [Illuminance::Footcandle, '1,076 391 x 10¹ cd x sr / m²', 10.76391];
        yield 'B60 lumen per square metre' => [Illuminance::LumenPerSquareMetre, 'cd x sr/m²', 1.0];
        yield 'LUX lux' => [Illuminance::Lux, 'cd x sr / m²', 1.0];

        // ── Impulse ──────────────────────────────────────────────────────────────

        yield 'M98 kilogram centimetre per second' => [Impulse::KilogramCentimetrePerSecond, '10⁻² kg x m/s', 0.01];
        yield 'M99 gram centimetre per second' => [Impulse::GramCentimetrePerSecond, '10⁻⁵ kg x m/s', 1e-05];
        yield 'N10 pound foot per second' => [Impulse::PoundFootPerSecond, '1,382 550 x 10⁻¹ kg x m/s', 0.138255];
        yield 'N11 pound inch per second' => [Impulse::PoundInchPerSecond, '1,152 125 x 10⁻² kg x m/s', 0.01152125];
        yield 'B31 kilogram metre per second' => [Impulse::KilogramMetrePerSecond, 'kg x m/s', 1.0];
        yield 'C57 newton second' => [Impulse::NewtonSecond, 'N x s', 1.0];

        // ── Inductance ───────────────────────────────────────────────────────────

        yield 'B90 microhenry' => [Inductance::Microhenry, '10⁻⁶ H', 1e-06];
        yield 'C14 millihenry' => [Inductance::Millihenry, '10⁻³ H', 0.001];
        yield 'C43 nanohenry' => [Inductance::Nanohenry, '10⁻⁹ H', 1e-09];
        yield 'C73 picohenry' => [Inductance::Picohenry, '10⁻¹² H', 1e-12];
        yield 'P24 kilohenry' => [Inductance::Kilohenry, '10³ H', 1000.0];
        yield '81 henry' => [Inductance::Henry, 'H', 1.0];

        // ── Irradiance ───────────────────────────────────────────────────────────

        yield 'C32 milliwatt per square metre' => [Irradiance::MilliwattPerSquareMetre, '10⁻³ W/m²', 0.001];
        yield 'C76 picowatt per square metre' => [Irradiance::PicowattPerSquareMetre, '10⁻¹² W/m²', 1e-12];
        yield 'D85 microwatt per square metre' => [Irradiance::MicrowattPerSquareMetre, '10⁻⁶ W/m²', 1e-06];
        yield 'N48 watt per square centimetre ' => [Irradiance::WattPerSquareCentimetre, '10⁴ W/m²', 10000.0];
        yield 'N49 watt per square inch ' => [Irradiance::WattPerSquareInch, '1,550 003 x 10³ W/m²', 1550.003];
        yield 'N50 British thermal unit (international table) per square foot hour' => [Irradiance::BritishThermalUnitInternationalTablePerSquareFootHour, '3,154 591 W/m²', 3.154591];
        yield 'N51 British thermal unit (thermochemical) per square foot hour' => [Irradiance::BritishThermalUnitThermochemicalPerSquareFootHour, '3,152 481 W/m²', 3.152481];
        yield 'N52 British thermal unit (thermochemical) per square foot minute' => [Irradiance::BritishThermalUnitThermochemicalPerSquareFootMinute, '1,891 489 x 10² W/m²', 189.1489];
        yield 'N53 British thermal unit (international table) per square foot second' => [Irradiance::BritishThermalUnitInternationalTablePerSquareFootSecond, '1,135 653 x 10⁴ W/m²', 11356.53];
        yield 'N54 British thermal unit (thermochemical) per square foot second' => [Irradiance::BritishThermalUnitThermochemicalPerSquareFootSecond, '1,134 893 x 10⁴ W/m²', 11348.93];
        yield 'N55 British thermal unit (international table) per square inch second' => [Irradiance::BritishThermalUnitInternationalTablePerSquareInchSecond, '1,634 246 x 10⁶ W/m²', 1634246.0];
        yield 'N56 calorie (thermochemical) per square centimetre minute' => [Irradiance::CalorieThermochemicalPerSquareCentimetreMinute, '6,973 333 x 10² W/m²', 697.3333];
        yield 'N57 calorie (thermochemical) per square centimetre second' => [Irradiance::CalorieThermochemicalPerSquareCentimetreSecond, '4,184 x 10⁴ W/m²', 41840.0];
        yield 'D54 watt per square metre' => [Irradiance::WattPerSquareMetre, 'W/m²', 1.0];

        // ── Kinematic Viscosity ──────────────────────────────────────────────────

        yield '4C centistokes' => [KinematicViscosity::Centistokes, '10⁻⁶ m²/s', 1e-06];
        yield '91 stokes' => [KinematicViscosity::Stokes, '10⁻⁴ m²/s', 0.0001];
        yield 'C17 millimetre squared per second' => [KinematicViscosity::MillimetreSquaredPerSecond, '10⁻⁶ m²/s', 1e-06];
        yield 'M79 square foot per hour ' => [KinematicViscosity::SquareFootPerHour, '2,580 64 x 10⁻⁵ m²/s', 2.58064e-05];
        yield 'M81 square centimetre per second' => [KinematicViscosity::SquareCentimetrePerSecond, '10⁻⁴ m²/s', 0.0001];
        yield 'S3 square foot per second' => [KinematicViscosity::SquareFootPerSecond, '0,092 903 04 m²/s', 0.09290304];
        yield 'S4 square metre per second' => [KinematicViscosity::SquareMetrePerSecond, 'm²/s', 1.0];

        // ── Length ───────────────────────────────────────────────────────────────

        yield '4H micrometre' => [Length::Micrometre, '10⁻⁶ m', 1e-06];
        yield 'A11 angstrom' => [Length::Angstrom, '10⁻¹⁰ m', 1e-10];
        yield 'A12 astronomical unit' => [Length::AstronomicalUnit, '1,495 978 70 × 10¹¹ m', 149597870000.0];
        yield 'A45 decametre' => [Length::Decametre, '10 m', 10.0];
        yield 'A71 femtometre' => [Length::Femtometre, '10⁻¹⁵ m', 1e-15];
        yield 'AK fathom' => [Length::Fathom, '1,828 8 m', 1.8288];
        yield 'B57 light year' => [Length::LightYear, '9,460 73 x 10¹⁵ m', 9460730000000000.0];
        yield 'C45 nanometre' => [Length::Nanometre, '10⁻⁹ m', 1e-09];
        yield 'CMT centimetre' => [Length::Centimetre, '10⁻² m', 0.01];
        yield 'DMT decimetre' => [Length::Decimetre, '10⁻¹ m', 0.1];
        yield 'FOT foot' => [Length::Foot, '0,304 8 m', 0.3048];
        yield 'HMT hectometre' => [Length::Hectometre, '10² m', 100.0];
        yield 'INH inch' => [Length::Inch, '25,4 x 10⁻³ m', 0.0254];
        yield 'KMT kilometre' => [Length::Kilometre, '10³ m', 1000.0];
        yield 'M49 chain (based on US survey foot)' => [Length::ChainBasedOnUSSurveyFoot, '2,011684 x 10 m', 20.11684];
        yield 'M50 furlong' => [Length::Furlong, '2,011 68 x 10² m', 201.168];
        yield 'M51 foot (US survey)' => [Length::FootUSSurvey, '3,048 006 x 10⁻¹ m', 0.3048006];
        yield 'MMT millimetre' => [Length::Millimetre, '10⁻³ m', 0.001];
        yield 'NMI nautical mile' => [Length::NauticalMile, '1 852 m', 1852.0];
        yield 'SMI mile (statute mile)' => [Length::MileStatuteMile, '1 609,344 m', 1609.344];
        yield 'X1 Gunter\'s chain' => [Length::GuntersChain, '20,116 8 m', 20.1168];
        yield 'YRD yard' => [Length::Yard, '0,914 4 m', 0.9144];
        yield 'MTR metre' => [Length::Metre, 'm', 1.0];

        // ── Luminous Intensity ───────────────────────────────────────────────────

        yield 'P33 kilocandela' => [LuminousIntensity::Kilocandela, '10³ cd', 1000.0];
        yield 'P34 millicandela' => [LuminousIntensity::Millicandela, '10⁻³ cd', 0.001];
        yield 'CDL candela' => [LuminousIntensity::Candela, 'cd', 1.0];

        // ── Magnetic Flux ────────────────────────────────────────────────────────

        yield 'C33 milliweber' => [MagneticFlux::Milliweber, '10⁻³ Wb', 0.001];
        yield 'P11 kiloweber' => [MagneticFlux::Kiloweber, '10³ Wb', 1000.0];
        yield 'WEB weber' => [MagneticFlux::Weber, 'Wb', 1.0];

        // ── Magnetic Flux Density ────────────────────────────────────────────────

        yield 'C29 millitesla' => [MagneticFluxDensity::Millitesla, '10⁻³ T', 0.001];
        yield 'C48 nanotesla' => [MagneticFluxDensity::Nanotesla, '10⁻⁹ T', 1e-09];
        yield 'D81 microtesla' => [MagneticFluxDensity::Microtesla, '10⁻⁶ T', 1e-06];
        yield 'P12 gamma' => [MagneticFluxDensity::Gamma, '10⁻⁹ T', 1e-09];
        yield 'P13 kilotesla' => [MagneticFluxDensity::Kilotesla, '10³ T', 1000.0];
        yield 'D33 tesla' => [MagneticFluxDensity::Tesla, 'T', 1.0];

        // ── Magnetic Vector Potential ────────────────────────────────────────────

        yield 'B56 kiloweber per metre' => [MagneticVectorPotential::KiloweberPerMetre, '10³ Wb/m', 1000.0];
        yield 'D60 weber per millimetre' => [MagneticVectorPotential::WeberPerMillimetre, '10³ Wb/m', 1000.0];
        yield 'D59 weber per metre' => [MagneticVectorPotential::WeberPerMetre, 'Wb/m', 1.0];

        // ── Mass ─────────────────────────────────────────────────────────────────

        yield '2U megagram' => [Mass::Megagram, '10³ kg', 1000.0];
        yield 'APZ troy ounce or apothecary ounce' => [Mass::TroyOunceOrApothecaryOunce, '3,110 348 x 10⁻³ kg', 0.003110348];
        yield 'CGM centigram' => [Mass::Centigram, '10⁻⁵ kg', 1e-05];
        yield 'CWA hundred pound (cwt) / hundred weight (US)' => [Mass::HundredPoundCwtHundredWeightUS, '45,359 2 kg', 45.3592];
        yield 'CWI hundred weight (UK)' => [Mass::HundredWeightUK, '50,802 35 kg', 50.8023];
        yield 'DG decigram' => [Mass::Decigram, '10⁻⁴ kg', 0.0001];
        yield 'DJ decagram' => [Mass::Decagram, '10⁻² kg', 0.01];
        yield 'DTN decitonne' => [Mass::Decitonne, '10² kg', 100.0];
        yield 'F13 slug' => [Mass::Slug, '1,459 390 x 10¹ kg', 14.5939];
        yield 'GRM gram' => [Mass::Gram, '10⁻³ kg', 0.001];
        yield 'GRN grain' => [Mass::Grain, '64,798 91 x 10⁻⁶ kg', 6.479891e-05];
        yield 'HGM hectogram' => [Mass::Hectogram, '10⁻¹ kg', 0.1];
        yield 'KTN kilotonne' => [Mass::Kilotonne, '10⁶ kg', 1000000.0];
        yield 'LBR pound' => [Mass::Pound, '0,453 592 37 kg', 0.45359237];
        yield 'LTN ton (UK) or long ton (US)' => [Mass::TonUKOrLongTonUS, '1,016 047 x 10³ kg', 1016.047];
        yield 'M86 pfund' => [Mass::Pfund, '0,5 kg', 0.5];
        yield 'MC microgram' => [Mass::Microgram, '10⁻⁹ kg', 1e-09];
        yield 'MGM milligram' => [Mass::Milligram, '10⁻⁶ kg', 1e-06];
        yield 'ONZ ounce' => [Mass::Ounce, '2,834 952 x 10⁻² kg', 0.02834952];
        yield 'STI stone (UK)' => [Mass::StoneUK, '6,350 293 kg', 6.350293];
        yield 'STN ton (US) or short ton (UK/US)' => [Mass::TonUSOrShortTonUKUS, '0,907184 7 x 10³ kg', 907.1847];
        yield 'TNE tonne (metric ton)' => [Mass::TonneMetricTon, '10³ kg', 1000.0];
        yield 'KGM kilogram' => [Mass::Kilogram, 'kg', 1.0];

        // ── Molar Concentration ──────────────────────────────────────────────────

        yield 'B46 kilomole per cubic metre' => [MolarConcentration::KilomolePerCubicMetre, '10³ mol/m³', 1000.0];
        yield 'C35 mole per cubic decimetre' => [MolarConcentration::MolePerCubicDecimetre, '10³ mol/m³', 1000.0];
        yield 'C38 mole per litre' => [MolarConcentration::MolePerLitre, '10³ mol/m³', 1000.0];
        yield 'C36 mole per cubic metre' => [MolarConcentration::MolePerCubicMetre, 'mol/m³', 1.0];
        yield 'M33 millimole per litre' => [MolarConcentration::MillimolePerLitre, 'mol/m³', 1.0];

        // ── Molar Mass ───────────────────────────────────────────────────────────

        yield 'A94 gram per mole' => [MolarMass::GramPerMole, '10⁻³ kg/mol', 0.001];
        yield 'D74 kilogram per mole' => [MolarMass::KilogramPerMole, 'kg/mol', 1.0];

        // ── Molar Thermodynamic Energy ───────────────────────────────────────────

        yield 'B44 kilojoule per mole' => [MolarThermodynamicEnergy::KilojoulePerMole, '10³ J/mol', 1000.0];
        yield 'B15 joule per mole' => [MolarThermodynamicEnergy::JoulePerMole, 'J/mol', 1.0];

        // ── Molar Volume ─────────────────────────────────────────────────────────

        yield 'A36 cubic centimetre per mole' => [MolarVolume::CubicCentimetrePerMole, '10⁻⁶ m³/mol', 1e-06];
        yield 'A37 cubic decimetre per mole' => [MolarVolume::CubicDecimetrePerMole, '10⁻³ m³/mol', 0.001];
        yield 'B58 litre per mole' => [MolarVolume::LitrePerMole, '10⁻³ m³/mol', 0.001];
        yield 'A40 cubic metre per mole' => [MolarVolume::CubicMetrePerMole, 'm³/mol', 1.0];

        // ── Power ────────────────────────────────────────────────────────────────

        yield '2I British thermal unit (international table) per hour' => [Power::BritishThermalUnitInternationalTablePerHour, '2,930 711x 10⁻¹ W', 0.2930711];
        yield 'A25 cheval vapeur' => [Power::ChevalVapeur, '7,354 988 x 10² W', 735.4988];
        yield 'A63 erg per second' => [Power::ErgPerSecond, '10⁻⁷ W', 1e-07];
        yield 'A74 foot pound-force per second' => [Power::FootPoundForcePerSecond, '1,355 818 W', 1.355818];
        yield 'A90 gigawatt' => [Power::Gigawatt, '10⁹ W', 1000000000.0];
        yield 'B39 kilogram-force metre per second' => [Power::KilogramForceMetrePerSecond, '9,806 65 W', 9.80665];
        yield 'BHP brake horse power' => [Power::BrakeHorsePower, '7,457 x 10² W', 745.7];
        yield 'C31 milliwatt' => [Power::Milliwatt, '10⁻³ W', 0.001];
        yield 'C49 nanowatt' => [Power::Nanowatt, '10⁻⁹ W', 1e-09];
        yield 'C75 picowatt' => [Power::Picowatt, '10⁻¹² W', 1e-12];
        yield 'D31 terawatt' => [Power::Terawatt, '10¹² W', 1000000000000.0];
        yield 'D80 microwatt' => [Power::Microwatt, '10⁻⁶ W', 1e-06];
        yield 'E15 kilocalorie (thermochemical) per hour' => [Power::KilocalorieThermochemicalPerHour, '1,162 22 W', 1.16222];
        yield 'F80 water horse power' => [Power::WaterHorsePower, '7,460 43 x 10² W', 746.043];
        yield 'HJ metric horse power' => [Power::MetricHorsePower, '735,498 75 W', 735.49875];
        yield 'J44 British thermal unit (international table) per minute' => [Power::BritishThermalUnitInternationalTablePerMinute, '17,584 266 W', 17.584266];
        yield 'J45 British thermal unit (international table) per second' => [Power::BritishThermalUnitInternationalTablePerSecond, '1,055 056 x 10³ W', 1055.056];
        yield 'J47 British thermal unit (thermochemical) per hour' => [Power::BritishThermalUnitThermochemicalPerHour, '0,292 875 1 W', 0.2928751];
        yield 'J51 British thermal unit (thermochemical) per minute' => [Power::BritishThermalUnitThermochemicalPerMinute, '17,572 50 W', 17.5725];
        yield 'J52 British thermal unit (thermochemical) per second' => [Power::BritishThermalUnitThermochemicalPerSecond, '1,054 350 x 10³ W', 1054.35];
        yield 'J81 calorie (thermochemical) per minute' => [Power::CalorieThermochemicalPerMinute, '6,973 333 x 10⁻² W', 0.06973333];
        yield 'J82 calorie (thermochemical) per second' => [Power::CalorieThermochemicalPerSecond, '4,184 W', 4.184];
        yield 'K15 foot pound-force per hour' => [Power::FootPoundForcePerHour, '3,766 161 x 10⁻⁴ W', 0.0003766161];
        yield 'K16 foot pound-force per minute' => [Power::FootPoundForcePerMinute, '2,259 697 x 10⁻² W', 0.02259697];
        yield 'K42 horsepower (boiler)' => [Power::HorsepowerBoiler, '9,809 50 x 10³ W', 9809.5];
        yield 'K43 horsepower (electric)' => [Power::HorsepowerElectric, '746 W', 746.0];
        yield 'K54 kilocalorie (thermochemical) per minute' => [Power::KilocalorieThermochemicalPerMinute, '69,733 33 W', 69.73333];
        yield 'K55 kilocalorie (thermochemical) per second' => [Power::KilocalorieThermochemicalPerSecond, '4,184 x 10³ W', 4184.0];
        yield 'KWT kilowatt' => [Power::Kilowatt, '10³ W', 1000.0];
        yield 'MAW megawatt' => [Power::Megawatt, '10⁶ W', 1000000.0];
        yield 'N12 Pferdestaerke' => [Power::Pferdestaerke, '7,354 988 x 10² W', 735.4988];
        yield 'P15 joule per minute' => [Power::JoulePerMinute, '1,666 67 × 10⁻² W', 0.016666666666];
        yield 'P16 joule per hour' => [Power::JoulePerHour, '2,777 78 × 10⁻⁴ W', 0.00027777777777];
        yield 'P17 joule per day' => [Power::JoulePerDay, '1,157 41 × 10⁻⁵ W', 1.157407407e-05];
        yield 'P18 kilojoule per second' => [Power::KilojoulePerSecond, '10³ W', 1000.0];
        yield 'P19 kilojoule per minute' => [Power::KilojoulePerMinute, '1,666 67 × 10 W', 16.6666666667];
        yield 'P20 kilojoule per hour' => [Power::KilojoulePerHour, '2,777 78 x 10⁻¹ W', 0.2777777778];
        yield 'P21 kilojoule per day' => [Power::KilojoulePerDay, '1,157 41 x 10⁻² W', 0.01157407407];
        yield 'D46 volt ampere' => [Power::VoltAmpere, 'W', 1.0];
        yield 'P14 joule per second' => [Power::JoulePerSecond, 'W', 1.0];
        yield 'WTT watt' => [Power::Watt, 'W', 1.0];

        // ── Pressure ─────────────────────────────────────────────────────────────

        yield '74 millipascal' => [Pressure::Millipascal, '10⁻³ Pa', 0.001];
        yield '84 kilopounds force per square inch' => [Pressure::KilopoundsForcePerSquareInch, '6,894 757 x 10⁶ Pa', 6894757.0];
        yield 'A89 gigapascal' => [Pressure::Gigapascal, '10⁹ Pa', 1000000000.0];
        yield 'A97 hectopascal' => [Pressure::Hectopascal, '10² Pa', 100.0];
        yield 'ATM standard atmosphere' => [Pressure::StandardAtmosphere, '1 013 25 Pa', 101325.0];
        yield 'ATT technical atmosphere' => [Pressure::TechnicalAtmosphere, '98 066,5 Pa', 98066.5];
        yield 'B40 kilogram-force per square metre' => [Pressure::KilogramForcePerSquareMetre, '9,806 65 Pa', 9.80665];
        yield 'B96 micropascal' => [Pressure::Micropascal, '10⁻⁶ Pa', 1e-06];
        yield 'BAR bar' => [Pressure::Bar, '10⁵ Pa', 100000.0];
        yield 'C56 newton per square millimetre' => [Pressure::NewtonPerSquareMillimetre, '10⁶ Pa', 1000000.0];
        yield 'E42 kilogram-force per square centimetre' => [Pressure::KilogramForcePerSquareCentimetre, '9,806 65 x 10⁴ Pa', 98066.5];
        yield 'F78 inch of water' => [Pressure::InchOfWater, '2,490 89 × 10² kg x m⁻¹ x s⁻²', 249.089];
        yield 'F79 inch of mercury' => [Pressure::InchOfMercury, '3,386 39 × 10³ kg x m⁻¹ x s⁻²', 3386.389];
        yield 'H75 decapascal' => [Pressure::Decapascal, '10¹ Pa', 10.0];
        yield 'H78 conventional centimetre of water' => [Pressure::ConventionalCentimetreOfWater, '9,806 65 × 10¹ Pa', 98.0665];
        yield 'HN millimetres of mercury' => [Pressure::MillimetresOfMercury, '133,322 4 Pa', 133.3224];
        yield 'HP conventional millimetre of water' => [Pressure::ConventionalMillimetreOfWater, '9,806 65 Pa', 9.80665];
        yield 'J89 centimetres of mercury' => [Pressure::CentimetresOfMercury, '1,333 224 x 10³ Pa', 1333.224];
        yield 'K24 foot of water' => [Pressure::FootOfWater, '2,989 067 x 10³  Pa', 2989.067];
        yield 'K25 foot of mercury' => [Pressure::FootOfMercury, '4,063 666 x 10⁴ Pa', 40636.66];
        yield 'K31 gram-force per square centimetre' => [Pressure::GramForcePerSquareCentimetre, '98,066 5 Pa', 98.0665];
        yield 'K85 pound-force per square foot' => [Pressure::PoundForcePerSquareFoot, '47,880 26 Pa', 47.88026];
        yield 'KPA kilopascal' => [Pressure::Kilopascal, '10³ Pa', 1000.0];
        yield 'MBR millibar' => [Pressure::Millibar, '10² Pa', 100.0];
        yield 'MPA megapascal' => [Pressure::Megapascal, '10⁶ Pa', 1000000.0];
        yield 'N13 centimetre of mercury (0 ºC)' => [Pressure::CentimetreOfMercury0c, '1,333 22 x 10³ Pa', 1333.22];
        yield 'N14 centimetre of water (4 ºC)' => [Pressure::CentimetreOfWater4c, '9,806 38 x 10 Pa', 98.0638];
        yield 'N15 foot of water (39.2 ºF)' => [Pressure::FootOfWater392f, '2,988 98 x 10³  Pa', 2988.98];
        yield 'N16 inch of mercury (32 ºF)' => [Pressure::InchOfMercury32f, '3,386 38 x 10³  Pa', 3386.38];
        yield 'N17 inch of mercury (60 ºF)' => [Pressure::InchOfMercury60f, '3,376 85 x 10³  Pa', 3376.85];
        yield 'N18 inch of water (39.2 ºF)' => [Pressure::InchOfWater392f, '2,490 82 × 10² Pa', 249.082];
        yield 'N19 inch of water (60 ºF)' => [Pressure::InchOfWater60f, '2,488 4 × 10² Pa', 248.84];
        yield 'N20 kip per square inch' => [Pressure::KipPerSquareInch, '6,894 757 x 10⁶ Pa', 6894757.0];
        yield 'N21 poundal per square foot' => [Pressure::PoundalPerSquareFoot, '1,488 164 Pa', 1.488164];
        yield 'N23 conventional metre of water' => [Pressure::ConventionalMetreOfWater, '9,806 65 x 10³ Pa', 9806.65];
        yield 'PS pound force per square inch' => [Pressure::PoundForcePerSquareInch, '6,894 757 x 10³ Pa', 6894.757];
        yield 'UA torr' => [Pressure::Torr, '133,322 4 Pa', 133.3224];
        yield 'C55 newton per square metre' => [Pressure::NewtonPerSquareMetre, 'Pa', 1.0];
        yield 'PAL pascal' => [Pressure::Pascal, 'Pa', 1.0];

        // ── Radioactivity ────────────────────────────────────────────────────────

        yield '2Q kilobecquerel' => [Radioactivity::Kilobecquerel, '10³ Bq', 1000.0];
        yield '2R kilocurie' => [Radioactivity::Kilocurie, '3,7 x 10¹³ Bq', 37000000000000.0];
        yield '4N megabecquerel' => [Radioactivity::Megabecquerel, '10⁶ Bq', 1000000.0];
        yield 'CUR curie' => [Radioactivity::Curie, '3,7 x 10¹⁰ Bq', 37000000000.0];
        yield 'GBQ gigabecquerel' => [Radioactivity::Gigabecquerel, '10⁹ Bq', 1000000000.0];
        yield 'H08 microbecquerel' => [Radioactivity::Microbecquerel, '10⁻⁶ Bq', 1e-06];
        yield 'M5 microcurie' => [Radioactivity::Microcurie, '3,7 x 10⁴ Bq', 37000.0];
        yield 'MCU millicurie' => [Radioactivity::Millicurie, '3,7 x 10⁷ Bq', 37000000.0];

        // ── Resistance ───────────────────────────────────────────────────────────

        yield 'A87 gigaohm' => [Resistance::Gigaohm, '10⁹ Ω', 1000000000.0];
        yield 'B49 kiloohm' => [Resistance::Kiloohm, '10³ Ω', 1000.0];
        yield 'B75 megaohm' => [Resistance::Megaohm, '10⁶ Ω', 1000000.0];
        yield 'B94 microohm' => [Resistance::Microohm, '10⁻⁶ Ω', 1e-06];
        yield 'E45 milliohm' => [Resistance::Milliohm, '10⁻³ Ω', 0.001];
        yield 'H44 teraohm' => [Resistance::Teraohm, '10¹² Ω', 1000000000000.0];
        yield 'P22 nanoohm' => [Resistance::Nanoohm, '10⁻⁹ Ω', 1e-09];
        yield 'OHM ohm' => [Resistance::Ohm, 'Ω', 1.0];

        // ── Specific Volume ──────────────────────────────────────────────────────

        yield '22 decilitre per gram' => [SpecificVolume::DecilitrePerGram, '10⁻¹ x m³/kg', 0.1];
        yield 'H83 litre per kilogram' => [SpecificVolume::LitrePerKilogram, '10⁻³ m³ x kg⁻¹', 0.001];
        yield 'KX millilitre per kilogram' => [SpecificVolume::MillilitrePerKilogram, '10⁻⁶ m³/kg', 1e-06];
        yield 'N28 cubic decimetre per kilogram' => [SpecificVolume::CubicDecimetrePerKilogram, '10⁻³ m³ x kg⁻¹', 0.001];
        yield 'N29 cubic foot per pound' => [SpecificVolume::CubicFootPerPound, '6,242 796 x 10⁻² m³/kg', 0.06242796];
        yield 'N30 cubic inch per pound' => [SpecificVolume::CubicInchPerPound, '3,612 728 x 10⁻⁵ m³/kg', 3.612728e-05];
        yield 'A39 cubic metre per kilogram' => [SpecificVolume::CubicMetrePerKilogram, 'm³/kg', 1.0];

        // ── Speed ────────────────────────────────────────────────────────────────

        yield '2M centimetres per second' => [Speed::CentimetresPerSecond, '10⁻² m/s', 0.01];
        yield '2X metre per minute' => [Speed::MetrePerMinute, '0,016 666 m/s', 0.016666666666666666];
        yield 'C16 millimetre per second' => [Speed::MillimetrePerSecond, '10⁻³ m/s', 0.001];
        yield 'FR foot per minute' => [Speed::FootPerMinute, '5,08 x 10⁻³ m/s', 0.00508];
        yield 'FS foot per second' => [Speed::FootPerSecond, '0,304 8 m/s', 0.3048];
        yield 'H49 centimetres per hour' => [Speed::CentimetresPerHour, '0,277 777 778 × 10⁻⁶ m x s⁻¹', 2.77777778e-07];
        yield 'H81 millimetre per minute' => [Speed::MillimetrePerMinute, '1,666 666 667 × 10⁻⁵ m x s⁻¹', 1.6666666666666e-05];
        yield 'HM miles per hour' => [Speed::MilesPerHour, '0,447 04 m/s', 0.44704];
        yield 'IU inch per second' => [Speed::InchPerSecond, '0,025 4 m/s', 0.0254];
        yield 'K14 foot per hour' => [Speed::FootPerHour, '8,466 667 x 10⁻⁵m/s', 8.466667e-05];
        yield 'KMH kilometres per hour' => [Speed::KilometresPerHour, '0,277 778 m/s', 0.277777778];
        yield 'KNT knot' => [Speed::Knot, '0,514 444 m/s', 0.514444];
        yield 'M57 miles per minute' => [Speed::MilesPerMinute, '26,822 4 m/s', 26.8224];
        yield 'M58 miles per second' => [Speed::MilesPerSecond, '1,609 344 x 10³ m/s', 1609.344];
        yield 'M60 metre per hour' => [Speed::MetrePerHour, '2,777 78 x 10⁻⁴ m/s', 0.0002777777777777];
        yield 'M61 inch per year' => [Speed::InchPerYear, '8,048 774 x 10⁻¹⁰ m/s', 8.048774e-10];
        yield 'M62 kilometres per second' => [Speed::KilometresPerSecond, '10³ m/s', 1000.0];
        yield 'M63 inch per minute' => [Speed::InchPerMinute, '4,233 333 x 10⁻⁴ m/s', 0.0004233333];
        yield 'M64 yard per second' => [Speed::YardPerSecond, '9,144 x 10⁻¹ m/s', 0.9144];
        yield 'M65 yard per minute' => [Speed::YardPerMinute, '1,524 x 10⁻² m/s', 0.01524];
        yield 'M66 yard per hour' => [Speed::YardPerHour, '2,54 x 10⁻⁴ m/s', 0.000254];
        yield 'MTS metres per second' => [Speed::MetresPerSecond, 'm/s', 1.0];

        // ── Temperature ──────────────────────────────────────────────────────────

        yield 'A48 degrees Rankine' => [Temperature::Rankine, '5/9 x K', 0.5555555555555556];
        yield 'CEL degrees Celsius' => [Temperature::Celsius, '1 x K', 1.0];
        yield 'FAH degrees Fahrenheit' => [Temperature::Fahrenheit, '5/9 x K', 0.5555555555555556];
        yield 'KEL kelvin' => [Temperature::Kelvin, 'K', 1.0];

        // ── Time ─────────────────────────────────────────────────────────────────

        yield 'ANN year' => [Time::Year, '3,155 76 x 10⁷ s', 31557600.0];
        yield 'B52 kilosecond' => [Time::Kilosecond, '10³ s', 1000.0];
        yield 'B98 microsecond' => [Time::Microsecond, '10⁻⁶ s', 1e-06];
        yield 'C26 millisecond' => [Time::Millisecond, '10⁻³ s', 0.001];
        yield 'C47 nanosecond' => [Time::Nanosecond, '10⁻⁹ s', 1e-09];
        yield 'DAY day' => [Time::Day, '86 400 s', 86400.0];
        yield 'H70 picosecond' => [Time::Picosecond, '10⁻¹² s', 1e-12];
        yield 'HUR hour' => [Time::Hour, '3 600 s', 3600.0];
        yield 'L95 common year' => [Time::CommonYear, '3,153 6 x 10⁷ s', 31536000.0];
        yield 'L96 sidereal year' => [Time::SiderealYear, '3,155 815 x 10⁷ s', 31558150.0];
        yield 'M56 shake' => [Time::Shake, '10⁻⁸ s', 1e-08];
        yield 'MIN minute' => [Time::Minute, '60 s', 60.0];
        yield 'MON month' => [Time::Month, '2,629 800 x 10⁶ s', 2629800.0];
        yield 'WEE week' => [Time::Week, '6,048 x 10⁵ s', 604800.0];
        yield 'SEC second' => [Time::Second, 's', 1.0];

        // ── Torque ───────────────────────────────────────────────────────────────

        yield 'B38 kilogram-force metre' => [Torque::KilogramForceMetre, '9,806 65 N x m', 9.80665];
        yield 'B48 kilonewton metre' => [Torque::KilonewtonMetre, '10³ N x m', 1000.0];
        yield 'B74 meganewton metre' => [Torque::MeganewtonMetre, '10⁶ N x m', 1000000.0];
        yield 'B93 micronewton metre' => [Torque::MicronewtonMetre, '10⁻⁶ N x m', 1e-06];
        yield 'D83 millinewton metre' => [Torque::MillinewtonMetre, '10⁻³ N x m', 0.001];
        yield 'DN decinewton metre' => [Torque::DecinewtonMetre, '10⁻¹ N x m', 0.1];
        yield 'F21 pound-force inch' => [Torque::PoundForceInch, '1,129 85 × 10⁻¹ kg x m² x s⁻²', 0.112985];
        yield 'F88 newton centimetre' => [Torque::NewtonCentimetre, '10⁻² kg x m² x s⁻²', 0.01];
        yield 'J72 centinewton metre' => [Torque::CentinewtonMetre, '10⁻² N x m', 0.01];
        yield 'J94 dyne centimetre' => [Torque::DyneCentimetre, '10⁻⁷ N x m', 1e-07];
        yield 'L41 ounce (avoirdupois)-force inch' => [Torque::OunceAvoirdupoisForceInch, '7,061 552 x 10⁻³ N x m', 0.007061552];
        yield 'M92 pound-force foot' => [Torque::PoundForceFoot, '1,355 818 N x m', 1.355818];
        yield 'M95 poundal foot' => [Torque::PoundalFoot, '4,214 011 x 10⁻² N x m', 0.04214011];
        yield 'M96 poundal inch' => [Torque::PoundalInch, '3,511 677 10⁻³ N x m', 0.003511677];
        yield 'M97 dyne metre' => [Torque::DyneMetre, '10⁻⁵ N x m', 1e-05];
        yield 'NU newton metre' => [Torque::NewtonMetre, 'N x m', 1.0];

        // ── Voltage ──────────────────────────────────────────────────────────────

        yield '2Z millivolt' => [Voltage::Millivolt, '10⁻³ V', 0.001];
        yield 'B78 megavolt' => [Voltage::Megavolt, '10⁶ V', 1000000.0];
        yield 'D82 microvolt' => [Voltage::Microvolt, '10⁻⁶ V', 1e-06];
        yield 'KVT kilovolt' => [Voltage::Kilovolt, '10³ V', 1000.0];
        yield 'N99 picovolt' => [Voltage::Picovolt, '10⁻¹² V', 1e-12];
        yield 'VLT volt' => [Voltage::Volt, 'V', 1.0];

        // ── Volume ───────────────────────────────────────────────────────────────

        yield '4G microlitre' => [Volume::Microlitre, '10⁻⁹ m³', 1e-09];
        yield '5I standard cubic foot' => [Volume::StandardCubicFoot, '4,672 m³', 4.672];
        yield 'A44 decalitre' => [Volume::Decalitre, '10⁻² m³', 0.01];
        yield 'BLD dry barrel (US)' => [Volume::DryBarrelUS, '1,156 27 x 10⁻¹ m³', 0.115627];
        yield 'BLL barrel (US)' => [Volume::BarrelUS, '158,987 3 x 10⁻³ m³', 0.1589873];
        yield 'BUA bushel (US)' => [Volume::BushelUS, '3,523 907 x 10⁻² m³', 0.03523907];
        yield 'BUI bushel (UK)' => [Volume::BushelUK, '3,636 872 x 10⁻² m³', 0.03636872];
        yield 'CLT centilitre' => [Volume::Centilitre, '10⁻⁵ m³', 1e-05];
        yield 'CMQ cubic centimetre' => [Volume::CubicCentimetre, '10⁻⁶ m³', 1e-06];
        yield 'DLT decilitre' => [Volume::Decilitre, '10⁻⁴ m³', 0.0001];
        yield 'DMA cubic decametre' => [Volume::CubicDecametre, '10³ m³', 1000.0];
        yield 'DMQ cubic decimetre' => [Volume::CubicDecimetre, '10⁻³ m³', 0.001];
        yield 'FTQ cubic foot' => [Volume::CubicFoot, '2,831 685 x 10⁻² m³', 0.02831684659];
        yield 'G21 cup [unit of volume]' => [Volume::CupunitOfVolume, '2,365 882 x 10⁻⁴ m³', 0.0002365882];
        yield 'G23 peck' => [Volume::Peck, '8,809 768 x 10⁻³ m³', 0.008809768];
        yield 'G24 tablespoon (US)' => [Volume::TablespoonUS, '1,478 676 x 10⁻⁵ m³', 1.478676e-05];
        yield 'G25 teaspoon (US)' => [Volume::TeaspoonUS, '4,928 922 x 10⁻⁶ m³', 4.928922e-06];
        yield 'GLD dry gallon (US)' => [Volume::DryGallonUS, '4,404 884 x 10⁻³ m³', 0.004404884];
        yield 'GLI gallon (UK)' => [Volume::GallonUK, '4,546 092 x 10⁻³ m³', 0.004546092];
        yield 'GLL gallon (US)' => [Volume::GallonUS, '3,785 412 x 10⁻³ m³', 0.003785412];
        yield 'H19 cubic hectometre' => [Volume::CubicHectometre, '10⁶ m³', 1000000.0];
        yield 'H20 cubic kilometre' => [Volume::CubicKilometre, '10⁹ m³', 1000000000.0];
        yield 'HLT hectolitre' => [Volume::Hectolitre, '10⁻¹ m³', 0.1];
        yield 'INQ cubic inch' => [Volume::CubicInch, '16,387 064 x 10⁻⁶ m³', 1.6387064e-05];
        yield 'J57 barrel (UK petroleum)' => [Volume::BarrelUKPetroleum, '0,159 113 15 m³', 0.15911315];
        yield 'L43 peck (UK)' => [Volume::PeckUK, '9,092 181 x 10⁻³ m³', 0.009092181];
        yield 'L61 pint (US dry)' => [Volume::PintUSDry, '5,506 105 x 10⁻⁴ m³', 0.0005506105];
        yield 'L62 quart (US dry)' => [Volume::QuartUSDry, '1,101 221 x 10⁻³ m³', 0.001101221];
        yield 'L84 ton (UK shipping)' => [Volume::TonUKShipping, '1,189 3 m³', 1.1893];
        yield 'L86 ton (US shipping)' => [Volume::TonUSShipping, '1,132 6 m³', 1.1326];
        yield 'LTR litre' => [Volume::Litre, '10⁻³ m³', 0.001];
        yield 'M67 acre-foot (based on U.S. survey foot)' => [Volume::AcreFootBasedOnUsSurveyFoot, '1,233 489 x 10³ m³', 1233.489];
        yield 'M68 cord (128 ft³)' => [Volume::Cord128Ft, '3,624 556 m³', 3.624556];
        yield 'M69 cubic mile (UK statute)' => [Volume::CubicMileUKStatute, '4,168 182 x 10⁹ m³', 4168182000.0];
        yield 'M70 ton. register ' => [Volume::TonRegister, '2,831 685 m³', 2.831685];
        yield 'MAL megalitre' => [Volume::Megalitre, '10³ m³', 1000.0];
        yield 'MLT millilitre' => [Volume::Millilitre, '10⁻⁶ m³', 1e-06];
        yield 'MMQ cubic millimetre' => [Volume::CubicMillimetre, '10⁻⁹ m³', 1e-09];
        yield 'OZA fluid ounce (US)' => [Volume::FluidOunceUS, '2,957 353 x 10⁻⁵ m³', 2.957353e-05];
        yield 'OZI fluid ounce (UK)' => [Volume::FluidOunceUK, '2,841 306 x 10⁻⁵ m³', 2.841306e-05];
        yield 'PT pint (US)' => [Volume::PintUS, '4, 731 76 x 10⁻⁴ m³', 0.000473176];
        yield 'PTD dry pint (US)' => [Volume::DryPintUS, '5,506 105 x 10⁻⁴ m³', 0.0005506105];
        yield 'PTI pint (UK)' => [Volume::PintUK, '5, 682 61 x 10⁻⁴ m³', 0.000568261];
        yield 'PTL liquid pint (US)' => [Volume::LiquidPintUS, '4, 731 765 x 10⁻⁴ m³', 0.0004731765];
        yield 'QT quart (US)' => [Volume::QuartUS, '0,946 352 9 x 10⁻³ m³', 0.0009463529];
        yield 'QTD dry quart (US)' => [Volume::DryQuartUS, '1,101 221 x 10⁻³ m³', 0.001101221];
        yield 'QTI quart (UK)' => [Volume::QuartUK, '1,136 522 5 x 10⁻³ m³', 0.0011365225];
        yield 'QTL liquid quart (US)' => [Volume::LiquidQuartUS, '9,463 529 x 10⁻⁴ m³', 0.0009463529];
        yield 'YDQ cubic yard' => [Volume::CubicYard, '0,764 555 m³', 0.764555];
        yield 'G26 stere' => [Volume::Stere, 'm³', 1.0];
        yield 'K6 kilolitre' => [Volume::Kilolitre, 'm³', 1.0];
        yield 'MTQ cubic metre' => [Volume::CubicMetre, 'm³', 1.0];
        yield 'NM3 Normalised cubic metre' => [Volume::NormalisedCubicMetre, 'm3', 1.0];
        yield 'SM3 Standard cubic metre' => [Volume::StandardCubicMetre, 'm3', 1.0];
    }

    // ==================================================================================
    // Physical Equivalence Cross-Checks
    // ==================================================================================

    #[DataProvider('rec20CrossCheckProvider')]
    public function testRec20CrossCheck(
        mixed $from,
        mixed $to,
        float $input,
        float $expected,
        float $delta,
        string $description,
    ): void {
        $result = Converter::convert($input)->from($from)->to($to);

        $this->assertEqualsWithDelta(
            $expected,
            $result->toFloat(),
            $delta,
            "Rec20 cross-check failed: {$description}",
        );
    }

    /**
     * Physical equivalence checks using well-known conversion relationships.
     *
     * @return iterable<string, array{mixed, mixed, float, float, float, string}>
     */
    public static function rec20CrossCheckProvider(): iterable
    {
        // ── Mass ──────────────────────────────────────────────────────────────────

        yield '1 kg = 1000 g' => [Mass::Kilogram, Mass::Gram, 1.0, 1000.0, 0.001, '1 kg = 1000 g'];
        yield '1 tonne = 1000 kg' => [Mass::TonneMetricTon, Mass::Kilogram, 1.0, 1000.0, 0.001, '1 tonne = 1000 kg'];
        yield '1 lb = 16 oz' => [Mass::Pound, Mass::Ounce, 1.0, 16.0, 0.01, '1 lb = 16 oz'];
        yield '1 lb = 453.59237 g' => [Mass::Pound, Mass::Gram, 1.0, 453.59237, 0.001, '1 lb = 453.59237 g'];

        // ── Length ─────────────────────────────────────────────────────────────────

        yield '1 km = 1000 m' => [Length::Kilometre, Length::Metre, 1.0, 1000.0, 0.001, '1 km = 1000 m'];
        yield '1 ft = 12 in' => [Length::Foot, Length::Inch, 1.0, 12.0, 0.001, '1 ft = 12 in'];
        yield '1 yd = 3 ft' => [Length::Yard, Length::Foot, 1.0, 3.0, 0.001, '1 yd = 3 ft'];
        yield '1 mile = 5280 ft' => [Length::MileStatuteMile, Length::Foot, 1.0, 5280.0, 0.01, '1 mile = 5280 ft'];
        yield '1 nmi = 1852 m' => [Length::NauticalMile, Length::Metre, 1.0, 1852.0, 0.01, '1 nmi = 1852 m'];
        yield '1 in = 2.54 cm' => [Length::Inch, Length::Centimetre, 1.0, 2.54, 0.001, '1 in = 2.54 cm'];

        // ── Temperature ───────────────────────────────────────────────────────────

        yield '0°C = 32°F' => [Temperature::Celsius, Temperature::Fahrenheit, 0.0, 32.0, 0.01, '0°C = 32°F'];
        yield '100°C = 212°F' => [Temperature::Celsius, Temperature::Fahrenheit, 100.0, 212.0, 0.01, '100°C = 212°F'];
        yield '-40°C = -40°F' => [Temperature::Celsius, Temperature::Fahrenheit, -40.0, -40.0, 0.01, '-40°C = -40°F'];
        yield '0°C = 273.15 K' => [Temperature::Celsius, Temperature::Kelvin, 0.0, 273.15, 0.01, '0°C = 273.15 K'];

        // ── Pressure ──────────────────────────────────────────────────────────────

        yield '1 atm = 101325 Pa' => [Pressure::StandardAtmosphere, Pressure::Pascal, 1.0, 101325.0, 0.1, '1 atm = 101325 Pa'];
        yield '1 bar = 100000 Pa' => [Pressure::Bar, Pressure::Pascal, 1.0, 100000.0, 0.1, '1 bar = 100000 Pa'];
        yield '1 atm = 760 mmHg' => [Pressure::StandardAtmosphere, Pressure::MillimetresOfMercury, 1.0, 760.0, 0.1, '1 atm = 760 mmHg'];
        yield '1 atm ≈ 14.696 psi' => [Pressure::StandardAtmosphere, Pressure::PoundForcePerSquareInch, 1.0, 14.696, 0.01, '1 atm ≈ 14.696 psi'];

        // ── Energy ────────────────────────────────────────────────────────────────

        yield '1 kWh = 3600000 J' => [Energy::KilowattHour, Energy::Joule, 1.0, 3600000.0, 0.01, '1 kWh = 3600000 J'];
        yield '1 BTU = 1055.056 J' => [Energy::BritishThermalUnitInternationalTable, Energy::Joule, 1.0, 1055.056, 0.01, '1 BTU = 1055.056 J'];

        // ── Volume ────────────────────────────────────────────────────────────────

        yield '1 m³ = 1000 L' => [Volume::CubicMetre, Volume::Litre, 1.0, 1000.0, 0.001, '1 m³ = 1000 L'];
        yield '1 US gal = 128 US fl oz' => [Volume::GallonUS, Volume::FluidOunceUS, 1.0, 128.0, 0.01, '1 US gal = 128 fl oz'];

        // ── Radioactivity ─────────────────────────────────────────────────────────

        yield '1 Ci = 3.7e10 Bq' => [Radioactivity::Curie, Radioactivity::Becquerel, 1.0, 37000000000.0, 100.0, '1 Ci = 3.7e10 Bq'];
    }

    // ==================================================================================
    // Round-Trip Accuracy
    // ==================================================================================

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
        yield 'pressure: atm-mmHg' => [Pressure::StandardAtmosphere, Pressure::MillimetresOfMercury, 2.5];
        yield 'pressure: atm-inHg' => [Pressure::StandardAtmosphere, Pressure::InchOfMercury, 1.0];
        yield 'capacitance: pF-nF' => [Capacitance::Picofarad, Capacitance::Nanofarad, 470.0];
        yield 'length: mile-km' => [Length::MileStatuteMile, Length::Kilometre, 26.2];
        yield 'volume: gal US-L' => [Volume::GallonUS, Volume::Litre, 5.0];
    }

    // ==================================================================================
    // Error Cases
    // ==================================================================================

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

    public function testStringAliasesAcrossCategories(): void
    {
        $result1 = Converter::convert(1)->from('KGM')->to('GRM');
        $result2 = Converter::convert(1)->from('kg')->to('g');
        $result3 = Converter::convert(1)->from('kilogram')->to('gram');

        $this->assertSame($result1->value, $result2->value);
        $this->assertSame($result2->value, $result3->value);
    }
}
