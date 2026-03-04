<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Irradiance: string implements Unit
{
    case MilliwattPerSquareMetre                                 = 'C32';
    case PicowattPerSquareMetre                                  = 'C76';
    case WattPerSquareMetre                                      = 'D54';
    case MicrowattPerSquareMetre                                 = 'D85';
    case WattPerSquareCentimetre                                 = 'N48';
    case WattPerSquareInch                                       = 'N49';
    case BritishThermalUnitInternationalTablePerSquareFootHour   = 'N50';
    case BritishThermalUnitThermochemicalPerSquareFootHour       = 'N51';
    case BritishThermalUnitThermochemicalPerSquareFootMinute     = 'N52';
    case BritishThermalUnitInternationalTablePerSquareFootSecond = 'N53';
    case BritishThermalUnitThermochemicalPerSquareFootSecond     = 'N54';
    case BritishThermalUnitInternationalTablePerSquareInchSecond = 'N55';
    case CalorieThermochemicalPerSquareCentimetreMinute          = 'N56';
    case CalorieThermochemicalPerSquareCentimetreSecond          = 'N57';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::MilliwattPerSquareMetre                                 => 'mW/m²',
            self::PicowattPerSquareMetre                                  => 'pW/m²',
            self::WattPerSquareMetre                                      => 'W/m²',
            self::MicrowattPerSquareMetre                                 => 'µW/m²',
            self::WattPerSquareCentimetre                                 => 'W/cm²',
            self::WattPerSquareInch                                       => 'W/in²',
            self::BritishThermalUnitInternationalTablePerSquareFootHour   => 'BtuIT/(ft²·h)',
            self::BritishThermalUnitThermochemicalPerSquareFootHour       => 'Btuth/(ft²·h)',
            self::BritishThermalUnitThermochemicalPerSquareFootMinute     => 'Btuth/(ft²·min) ',
            self::BritishThermalUnitInternationalTablePerSquareFootSecond => 'BtuIT/(ft²·s)',
            self::BritishThermalUnitThermochemicalPerSquareFootSecond     => 'Btuth/(ft²·s)',
            self::BritishThermalUnitInternationalTablePerSquareInchSecond => 'BtuIT/(in²·s)',
            self::CalorieThermochemicalPerSquareCentimetreMinute          => 'calth/(cm²·min)',
            self::CalorieThermochemicalPerSquareCentimetreSecond          => 'calth/(cm²·s)',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::MilliwattPerSquareMetre                                 => 'milliwatt per square metre',
            self::PicowattPerSquareMetre                                  => 'picowatt per square metre',
            self::WattPerSquareMetre                                      => 'watt per square metre',
            self::MicrowattPerSquareMetre                                 => 'microwatt per square metre',
            self::WattPerSquareCentimetre                                 => 'watt per square centimetre ',
            self::WattPerSquareInch                                       => 'watt per square inch ',
            self::BritishThermalUnitInternationalTablePerSquareFootHour   => 'British thermal unit (international table) per square foot hour',
            self::BritishThermalUnitThermochemicalPerSquareFootHour       => 'British thermal unit (thermochemical) per square foot hour',
            self::BritishThermalUnitThermochemicalPerSquareFootMinute     => 'British thermal unit (thermochemical) per square foot minute',
            self::BritishThermalUnitInternationalTablePerSquareFootSecond => 'British thermal unit (international table) per square foot second',
            self::BritishThermalUnitThermochemicalPerSquareFootSecond     => 'British thermal unit (thermochemical) per square foot second',
            self::BritishThermalUnitInternationalTablePerSquareInchSecond => 'British thermal unit (international table) per square inch second',
            self::CalorieThermochemicalPerSquareCentimetreMinute          => 'calorie (thermochemical) per square centimetre minute',
            self::CalorieThermochemicalPerSquareCentimetreSecond          => 'calorie (thermochemical) per square centimetre second',
        };
    }

    /**
     * @return list<string>
     */
    public function aliases(): array
    {
        return [$this->value, $this->symbol(), $this->label()];
    }

    public function multiplier(): string
    {
        return match ($this) {
            self::MilliwattPerSquareMetre                                 => '0.001',
            self::PicowattPerSquareMetre                                  => '0.000000000001',
            self::WattPerSquareMetre                                      => '1',
            self::MicrowattPerSquareMetre                                 => '0.000001',
            self::WattPerSquareCentimetre                                 => '10000',
            self::WattPerSquareInch                                       => '1550.003',
            self::BritishThermalUnitInternationalTablePerSquareFootHour   => '3.154591',
            self::BritishThermalUnitThermochemicalPerSquareFootHour       => '3.152481',
            self::BritishThermalUnitThermochemicalPerSquareFootMinute     => '189.1489',
            self::BritishThermalUnitInternationalTablePerSquareFootSecond => '11356.53',
            self::BritishThermalUnitThermochemicalPerSquareFootSecond     => '11348.93',
            self::BritishThermalUnitInternationalTablePerSquareInchSecond => '1634246',
            self::CalorieThermochemicalPerSquareCentimetreMinute          => '697.3333',
            self::CalorieThermochemicalPerSquareCentimetreSecond          => '41840',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Irradiance;
    }
}
