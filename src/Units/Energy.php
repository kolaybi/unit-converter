<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Energy: string implements Unit
{
    case Joule                                = 'JOU';
    case Kilojoule                            = 'KJO';
    case Exajoule                             = 'A68';
    case Petajoule                            = 'C68';
    case Terajoule                            = 'D30';
    case Gigajoule                            = 'GV';
    case Megajoule                            = '3B';
    case Millijoule                           = 'C15';
    case Femtojoule                           = 'A70';
    case Attojoule                            = 'A13';
    case WattHour                             = 'WHR';
    case MegawattHour                         = 'MWH';
    case KilowattHour                         = 'KWH';
    case GigawattHour                         = 'GWH';
    case TerawattHour                         = 'D32';
    case Electronvolt                         = 'A53';
    case Megaelectronvolt                     = 'B71';
    case Gigaelectronvolt                     = 'A85';
    case Kiloelectronvolt                     = 'B29';
    case Erg                                  = 'A57';
    case FootPoundForce                       = '85';
    case KilogramForceMetre                   = 'B38';
    case FootPoundal                          = 'N46';
    case InchPoundal                          = 'N47';
    case CalorieInternationalTable            = 'D60';
    case CalorieMean                          = 'J75';
    case KilocalorieInternationalTable        = 'E14';
    case KilocalorieMean                      = 'K51';
    case KilocalorieThermochemical            = 'K53';
    case BritishThermalUnitInternationalTable = 'BTU';
    case BritishThermalUnitMean               = 'J37';
    case ThermEc                              = 'N71';
    case ThermUS                              = 'N72';
    case WattSecond                           = 'J55';

    public function symbol(): string
    {
        return match ($this) {
            self::Joule                                => 'J',
            self::Kilojoule                            => 'kJ',
            self::Exajoule                             => 'EJ',
            self::Petajoule                            => 'PJ',
            self::Terajoule                            => 'TJ',
            self::Gigajoule                            => 'GJ',
            self::Megajoule                            => 'MJ',
            self::Millijoule                           => 'mJ',
            self::Femtojoule                           => 'fJ',
            self::Attojoule                            => 'aJ',
            self::WattHour                             => 'W·h',
            self::MegawattHour                         => 'MW·h',
            self::KilowattHour                         => 'kW·h',
            self::GigawattHour                         => 'GW·h',
            self::TerawattHour                         => 'TW·h',
            self::Electronvolt                         => 'eV',
            self::Megaelectronvolt                     => 'MeV',
            self::Gigaelectronvolt                     => 'GeV',
            self::Kiloelectronvolt                     => 'keV',
            self::Erg                                  => 'erg',
            self::FootPoundForce                       => 'ft·lbf',
            self::KilogramForceMetre                   => 'kgf·m',
            self::FootPoundal                          => 'ft·pdl',
            self::InchPoundal                          => 'in·pdl',
            self::CalorieInternationalTable            => 'cal(IT)',
            self::CalorieMean                          => 'cal',
            self::KilocalorieInternationalTable        => 'kcal(IT)',
            self::KilocalorieMean                      => 'kcal',
            self::KilocalorieThermochemical            => 'kcal(TH)',
            self::BritishThermalUnitInternationalTable => 'Btu(IT)',
            self::BritishThermalUnitMean               => 'Btu',
            self::ThermEc                              => 'thm(EC)',
            self::ThermUS                              => 'thm(US)',
            self::WattSecond                           => 'Ws',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Joule                                => 'joule',
            self::Kilojoule                            => 'kilojoule',
            self::Exajoule                             => 'exajoule',
            self::Petajoule                            => 'petajoule',
            self::Terajoule                            => 'terajoule',
            self::Gigajoule                            => 'gigajoule',
            self::Megajoule                            => 'megajoule',
            self::Millijoule                           => 'millijoule',
            self::Femtojoule                           => 'femtojoule',
            self::Attojoule                            => 'attojoule',
            self::WattHour                             => 'watt hour',
            self::MegawattHour                         => 'megawatt hour',
            self::KilowattHour                         => 'kilowatt hour',
            self::GigawattHour                         => 'gigawatt hour',
            self::TerawattHour                         => 'terawatt hour',
            self::Electronvolt                         => 'electronvolt',
            self::Megaelectronvolt                     => 'megaelectronvolt',
            self::Gigaelectronvolt                     => 'gigaelectronvolt',
            self::Kiloelectronvolt                     => 'kiloelectronvolt',
            self::Erg                                  => 'erg',
            self::FootPoundForce                       => 'foot pound-force',
            self::KilogramForceMetre                   => 'kilogram-force metre',
            self::FootPoundal                          => 'foot poundal',
            self::InchPoundal                          => 'inch poundal',
            self::CalorieInternationalTable            => 'calorie (international table)',
            self::CalorieMean                          => 'calorie (mean)',
            self::KilocalorieInternationalTable        => 'kilocalorie (international table)',
            self::KilocalorieMean                      => 'kilocalorie (mean)',
            self::KilocalorieThermochemical            => 'kilocalorie (thermochemical)',
            self::BritishThermalUnitInternationalTable => 'British thermal unit (international table)',
            self::BritishThermalUnitMean               => 'British thermal unit (mean)',
            self::ThermEc                              => 'therm (EC)',
            self::ThermUS                              => 'therm (US)',
            self::WattSecond                           => 'watt second',
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
            self::Joule                                => '1',
            self::Kilojoule                            => '1000',
            self::Exajoule                             => '1000000000000000000',
            self::Petajoule                            => '1000000000000000',
            self::Terajoule                            => '1000000000000',
            self::Gigajoule                            => '1000000000',
            self::Megajoule                            => '1000000',
            self::Millijoule                           => '0.001',
            self::Femtojoule                           => '0.000000000000001',
            self::Attojoule                            => '0.000000000000000001',
            self::WattHour                             => '3600',
            self::MegawattHour                         => '3600000000',
            self::KilowattHour                         => '3600000',
            self::GigawattHour                         => '3600000000000',
            self::TerawattHour                         => '3600000000000000',
            self::Electronvolt                         => '0.0000000000000000001602176487',
            self::Megaelectronvolt                     => '0.0000000000001602176487',
            self::Gigaelectronvolt                     => '0.0000000001602176487',
            self::Kiloelectronvolt                     => '0.0000000000000001602176487',
            self::Erg                                  => '0.0000001',
            self::FootPoundForce                       => '1.355818',
            self::KilogramForceMetre                   => '9.80665',
            self::FootPoundal                          => '0.04214011',
            self::InchPoundal                          => '0.003511677',
            self::CalorieInternationalTable            => '4.1868',
            self::CalorieMean                          => '4.19002',
            self::KilocalorieInternationalTable        => '4186.8',
            self::KilocalorieMean                      => '4190.02',
            self::KilocalorieThermochemical            => '4184',
            self::BritishThermalUnitInternationalTable => '1055.056',
            self::BritishThermalUnitMean               => '1055.87',
            self::ThermEc                              => '105506000',
            self::ThermUS                              => '105480400',
            self::WattSecond                           => '1',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Energy;
    }
}
