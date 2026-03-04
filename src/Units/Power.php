<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Power: string implements Unit
{
    case Watt                                               = 'WTT';
    case Kilowatt                                           = 'KWT';
    case Megawatt                                           = 'MAW';
    case Gigawatt                                           = 'A90';
    case Terawatt                                           = 'D31';
    case Milliwatt                                          = 'C31';
    case Microwatt                                          = 'D80';
    case Nanowatt                                           = 'C49';
    case Picowatt                                           = 'C75';
    case WaterHorsePower                                    = 'F80';
    case ErgPerSecond                                       = 'A63';
    case FootPoundForcePerSecond                            = 'A74';
    case KilogramForceMetrePerSecond                        = 'B39';
    case MetricHorsePower                                   = 'HJ';
    case ChevalVapeur                                       = 'A25';
    case BrakeHorsePower                                    = 'BHP';
    case FootPoundForcePerHour                              = 'K15';
    case FootPoundForcePerMinute                            = 'K16';
    case HorsepowerBoiler                                   = 'K42';
    case HorsepowerElectric                                 = 'K43';
    case Pferdestaerke                                      = 'N12';
    case BritishThermalUnitInternationalTablePerHour        = '2I';
    case VoltAmpere                                         = 'D46';
    case KilocalorieThermochemicalPerHour                   = 'E15';
    case MillionBritishThermalUnitInternationalTablePerHour = 'E16';
    case BritishThermalUnitInternationalTablePerMinute      = 'J44';
    case BritishThermalUnitInternationalTablePerSecond      = 'J45';
    case BritishThermalUnitThermochemicalPerHour            = 'J47';
    case BritishThermalUnitThermochemicalPerMinute          = 'J51';
    case BritishThermalUnitThermochemicalPerSecond          = 'J52';
    case CalorieThermochemicalPerMinute                     = 'J81';
    case CalorieThermochemicalPerSecond                     = 'J82';
    case KilocalorieThermochemicalPerMinute                 = 'K54';
    case KilocalorieThermochemicalPerSecond                 = 'K55';
    case JoulePerSecond                                     = 'P14';
    case JoulePerMinute                                     = 'P15';
    case JoulePerHour                                       = 'P16';
    case JoulePerDay                                        = 'P17';
    case KilojoulePerSecond                                 = 'P18';
    case KilojoulePerMinute                                 = 'P19';
    case KilojoulePerHour                                   = 'P20';
    case KilojoulePerDay                                    = 'P21';

    public function symbol(): string
    {
        return match ($this) {
            self::Watt                                               => 'W',
            self::Kilowatt                                           => 'kW',
            self::Megawatt                                           => 'MW',
            self::Gigawatt                                           => 'GW',
            self::Terawatt                                           => 'TW',
            self::Milliwatt                                          => 'mW',
            self::Microwatt                                          => 'µW',
            self::Nanowatt                                           => 'nW',
            self::Picowatt                                           => 'pW',
            self::WaterHorsePower                                    => 'water hp	',
            self::ErgPerSecond                                       => 'erg/s',
            self::FootPoundForcePerSecond                            => 'ft·lbf/s',
            self::KilogramForceMetrePerSecond                        => 'kgf·m/s',
            self::MetricHorsePower                                   => 'metric hp',
            self::ChevalVapeur                                       => 'CV',
            self::BrakeHorsePower                                    => 'BHP',
            self::FootPoundForcePerHour                              => 'ft·lbf/h',
            self::FootPoundForcePerMinute                            => 'ft·lbf/min',
            self::HorsepowerBoiler                                   => 'boiler hp',
            self::HorsepowerElectric                                 => 'electric hp',
            self::Pferdestaerke                                      => 'PS',
            self::BritishThermalUnitInternationalTablePerHour        => 'BtuIT/h',
            self::VoltAmpere                                         => 'V.A',
            self::KilocalorieThermochemicalPerHour                   => 'kcalth/h',
            self::MillionBritishThermalUnitInternationalTablePerHour => 'M BtuIT/h',
            self::BritishThermalUnitInternationalTablePerMinute      => 'BtuIT/min',
            self::BritishThermalUnitInternationalTablePerSecond      => 'BtuIT/s',
            self::BritishThermalUnitThermochemicalPerHour            => 'BtuIT/h',
            self::BritishThermalUnitThermochemicalPerMinute          => 'Btuth/min',
            self::BritishThermalUnitThermochemicalPerSecond          => 'Btuth/s',
            self::CalorieThermochemicalPerMinute                     => 'calth/min',
            self::CalorieThermochemicalPerSecond                     => 'calth/s',
            self::KilocalorieThermochemicalPerMinute                 => 'kcalth/min',
            self::KilocalorieThermochemicalPerSecond                 => 'kcalth/s',
            self::JoulePerSecond                                     => 'J/s',
            self::JoulePerMinute                                     => 'J/min',
            self::JoulePerHour                                       => 'J/h',
            self::JoulePerDay                                        => 'J/d',
            self::KilojoulePerSecond                                 => 'kJ/s',
            self::KilojoulePerMinute                                 => 'kJ/min',
            self::KilojoulePerHour                                   => 'kJ/h',
            self::KilojoulePerDay                                    => 'kJ/d',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Watt                                               => 'watt',
            self::Kilowatt                                           => 'kilowatt',
            self::Megawatt                                           => 'megawatt',
            self::Gigawatt                                           => 'gigawatt',
            self::Terawatt                                           => 'terawatt',
            self::Milliwatt                                          => 'milliwatt',
            self::Microwatt                                          => 'microwatt',
            self::Nanowatt                                           => 'nanowatt',
            self::Picowatt                                           => 'picowatt',
            self::WaterHorsePower                                    => 'water horse power',
            self::ErgPerSecond                                       => 'erg per second',
            self::FootPoundForcePerSecond                            => 'foot pound-force per second',
            self::KilogramForceMetrePerSecond                        => 'kilogram-force metre per second',
            self::MetricHorsePower                                   => 'metric horse power',
            self::ChevalVapeur                                       => 'cheval vapeur',
            self::BrakeHorsePower                                    => 'brake horse power',
            self::FootPoundForcePerHour                              => 'foot pound-force per hour',
            self::FootPoundForcePerMinute                            => 'foot pound-force per minute',
            self::HorsepowerBoiler                                   => 'horsepower (boiler)',
            self::HorsepowerElectric                                 => 'horsepower (electric)',
            self::Pferdestaerke                                      => 'Pferdestaerke',
            self::BritishThermalUnitInternationalTablePerHour        => 'British thermal unit (international table) per hour',
            self::VoltAmpere                                         => 'volt ampere',
            self::KilocalorieThermochemicalPerHour                   => 'kilocalorie (thermochemical) per hour',
            self::MillionBritishThermalUnitInternationalTablePerHour => 'million British thermal unit (international table) per hour',
            self::BritishThermalUnitInternationalTablePerMinute      => 'British thermal unit (international table) per minute',
            self::BritishThermalUnitInternationalTablePerSecond      => 'British thermal unit (international table) per second',
            self::BritishThermalUnitThermochemicalPerHour            => 'British thermal unit (thermochemical) per hour',
            self::BritishThermalUnitThermochemicalPerMinute          => 'British thermal unit (thermochemical) per minute',
            self::BritishThermalUnitThermochemicalPerSecond          => 'British thermal unit (thermochemical) per second',
            self::CalorieThermochemicalPerMinute                     => 'calorie (thermochemical) per minute',
            self::CalorieThermochemicalPerSecond                     => 'calorie (thermochemical) per second',
            self::KilocalorieThermochemicalPerMinute                 => 'kilocalorie (thermochemical) per minute',
            self::KilocalorieThermochemicalPerSecond                 => 'kilocalorie (thermochemical) per second',
            self::JoulePerSecond                                     => 'joule per second',
            self::JoulePerMinute                                     => 'joule per minute',
            self::JoulePerHour                                       => 'joule per hour',
            self::JoulePerDay                                        => 'joule per day',
            self::KilojoulePerSecond                                 => 'kilojoule per second',
            self::KilojoulePerMinute                                 => 'kilojoule per minute',
            self::KilojoulePerHour                                   => 'kilojoule per hour',
            self::KilojoulePerDay                                    => 'kilojoule per day',
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
            self::Watt                                               => '1',
            self::Kilowatt                                           => '1000',
            self::Megawatt                                           => '1000000',
            self::Gigawatt                                           => '1000000000',
            self::Terawatt                                           => '1000000000000',
            self::Milliwatt                                          => '0.001',
            self::Microwatt                                          => '0.000001',
            self::Nanowatt                                           => '0.000000001',
            self::Picowatt                                           => '0.000000000001',
            self::WaterHorsePower                                    => '746.043',
            self::ErgPerSecond                                       => '0.0000001',
            self::FootPoundForcePerSecond                            => '1.355818',
            self::KilogramForceMetrePerSecond                        => '9.80665',
            self::MetricHorsePower                                   => '735.49875',
            self::ChevalVapeur                                       => '735.4988',
            self::BrakeHorsePower                                    => '745.7',
            self::FootPoundForcePerHour                              => '0.0003766161',
            self::FootPoundForcePerMinute                            => '0.02259697',
            self::HorsepowerBoiler                                   => '9809.5',
            self::HorsepowerElectric                                 => '746',
            self::Pferdestaerke                                      => '735.4988',
            self::BritishThermalUnitInternationalTablePerHour        => '0.2930711',
            self::VoltAmpere                                         => '1',
            self::KilocalorieThermochemicalPerHour                   => '1.16222',
            self::MillionBritishThermalUnitInternationalTablePerHour => '293071.1',
            self::BritishThermalUnitInternationalTablePerMinute      => '17.584266',
            self::BritishThermalUnitInternationalTablePerSecond      => '1055.056',
            self::BritishThermalUnitThermochemicalPerHour            => '0.2928751',
            self::BritishThermalUnitThermochemicalPerMinute          => '17.5725',
            self::BritishThermalUnitThermochemicalPerSecond          => '1054.35',
            self::CalorieThermochemicalPerMinute                     => '0.06973333',
            self::CalorieThermochemicalPerSecond                     => '4.184',
            self::KilocalorieThermochemicalPerMinute                 => '69.73333',
            self::KilocalorieThermochemicalPerSecond                 => '4184',
            self::JoulePerSecond                                     => '1',
            self::JoulePerMinute                                     => '0.016666666666',
            self::JoulePerHour                                       => '0.00027777777777',
            self::JoulePerDay                                        => '0.00001157407407',
            self::KilojoulePerSecond                                 => '1000',
            self::KilojoulePerMinute                                 => '16.6666666667',
            self::KilojoulePerHour                                   => '0.2777777778',
            self::KilojoulePerDay                                    => '0.01157407407',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Power;
    }
}
