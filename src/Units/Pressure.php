<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Pressure: string implements Unit
{
    case Pascal                           = 'PAL';
    case Decapascal                       = 'H75';
    case Millipascal                      = '74';
    case Gigapascal                       = 'A89';
    case Hectopascal                      = 'A97';
    case Micropascal                      = 'B96';
    case Kilopascal                       = 'KPA';
    case Megapascal                       = 'MPA';
    case Bar                              = 'BAR';
    case Millibar                         = 'MBR';
    case NewtonPerSquareMetre             = 'C55';
    case NewtonPerSquareMillimetre        = 'C56';
    case KilogramForcePerSquareMetre      = 'B40';
    case Torr                             = 'UA';
    case PoundPerSquareInchAbsolute       = '80';
    case ConventionalCentimetreOfWater    = 'H78';
    case ConventionalMillimetreOfWater    = 'HP';
    case InchOfMercury                    = 'F79';
    case InchOfWater                      = 'F78';
    case TechnicalAtmosphere              = 'ATT';
    case StandardAtmosphere               = 'ATM';
    case CentimetresOfMercury             = 'J89';
    case FootOfWater                      = 'K24';
    case FootOfMercury                    = 'K25';
    case GramForcePerSquareCentimetre     = 'K31';
    case KilogramForcePerSquareCentimetre = 'E42';
    case KilogramForcePerSquareMillimetre = 'E41';
    case PoundForcePerSquareFoot          = 'K85';
    case KilopoundsForcePerSquareInch     = '84';
    case CentimetreOfMercury0c            = 'N13';
    case CentimetreOfWater4c              = 'N14';
    case FootOfWater392f                  = 'N15';
    case InchOfMercury32f                 = 'N16';
    case InchOfMercury60f                 = 'N17';
    case InchOfWater392f                  = 'N18';
    case InchOfWater60f                   = 'N19';
    case KipPerSquareInch                 = 'N20';
    case PoundalPerSquareFoot             = 'N21';
    case OunceAvoirdupoisPerSquareInch    = 'N22';
    case ConventionalMetreOfWater         = 'N23';
    case MillimetresOfMercury             = 'HN';
    case PoundForcePerSquareInch          = 'PS';

    public function symbol(): string
    {
        return match ($this) {
            self::Pascal                           => 'Pa',
            self::Decapascal                       => 'daPa',
            self::Millipascal                      => 'mPa',
            self::Gigapascal                       => 'GPa',
            self::Hectopascal                      => 'hPa',
            self::Micropascal                      => 'µPa',
            self::Kilopascal                       => 'kPa',
            self::Megapascal                       => 'MPa',
            self::Bar                              => 'bar',
            self::Millibar                         => 'mbar',
            self::NewtonPerSquareMetre             => 'N/m²',
            self::NewtonPerSquareMillimetre        => 'N/mm²',
            self::KilogramForcePerSquareMetre      => 'kgf/m²',
            self::Torr                             => 'Torr',
            self::PoundPerSquareInchAbsolute       => 'lb/in²',
            self::ConventionalCentimetreOfWater    => 'cm H₂O',
            self::ConventionalMillimetreOfWater    => 'mm H₂O',
            self::InchOfMercury                    => 'inHg',
            self::InchOfWater                      => 'inH₂O',
            self::TechnicalAtmosphere              => 'at',
            self::StandardAtmosphere               => 'atm',
            self::CentimetresOfMercury             => 'cm Hg',
            self::FootOfWater                      => 'ft H₂O',
            self::FootOfMercury                    => 'ft Hg',
            self::GramForcePerSquareCentimetre     => 'gf/cm²',
            self::KilogramForcePerSquareCentimetre => 'kgf/cm²',
            self::KilogramForcePerSquareMillimetre => 'kgf·/mm²',
            self::PoundForcePerSquareFoot          => 'lbf/ft²',
            self::KilopoundsForcePerSquareInch     => 'klbf/in²',
            self::CentimetreOfMercury0c            => 'cmHg (0 ºC)',
            self::CentimetreOfWater4c              => 'cmH₂O (4 ºC)',
            self::FootOfWater392f                  => 'ftH₂O (392 ºF)',
            self::InchOfMercury32f                 => 'inHG (32 ºF)',
            self::InchOfMercury60f                 => 'inHg (60 ºF)',
            self::InchOfWater392f                  => 'inH₂O (392 ºF)',
            self::InchOfWater60f                   => 'inH₂O (60 ºF)',
            self::KipPerSquareInch                 => 'ksi',
            self::PoundalPerSquareFoot             => 'pdl/ft²',
            self::OunceAvoirdupoisPerSquareInch    => 'oz/in²',
            self::ConventionalMetreOfWater         => 'mH₂O',
            self::MillimetresOfMercury             => 'mm Hg',
            self::PoundForcePerSquareInch          => 'psi',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Pascal                           => 'pascal',
            self::Decapascal                       => 'decapascal',
            self::Millipascal                      => 'millipascal',
            self::Gigapascal                       => 'gigapascal',
            self::Hectopascal                      => 'hectopascal',
            self::Micropascal                      => 'micropascal',
            self::Kilopascal                       => 'kilopascal',
            self::Megapascal                       => 'megapascal',
            self::Bar                              => 'bar',
            self::Millibar                         => 'millibar',
            self::NewtonPerSquareMetre             => 'newton per square metre',
            self::NewtonPerSquareMillimetre        => 'newton per square millimetre',
            self::KilogramForcePerSquareMetre      => 'kilogram-force per square metre',
            self::Torr                             => 'torr',
            self::PoundPerSquareInchAbsolute       => 'pound per square inch absolute',
            self::ConventionalCentimetreOfWater    => 'conventional centimetre of water',
            self::ConventionalMillimetreOfWater    => 'conventional millimetre of water',
            self::InchOfMercury                    => 'inch of mercury',
            self::InchOfWater                      => 'inch of water',
            self::TechnicalAtmosphere              => 'technical atmosphere',
            self::StandardAtmosphere               => 'standard atmosphere',
            self::CentimetresOfMercury             => 'centimetres of mercury',
            self::FootOfWater                      => 'foot of water',
            self::FootOfMercury                    => 'foot of mercury',
            self::GramForcePerSquareCentimetre     => 'gram-force per square centimetre',
            self::KilogramForcePerSquareCentimetre => 'kilogram-force per square centimetre',
            self::KilogramForcePerSquareMillimetre => 'kilogram-force per square millimetre',
            self::PoundForcePerSquareFoot          => 'pound-force per square foot',
            self::KilopoundsForcePerSquareInch     => 'kilopounds force per square inch',
            self::CentimetreOfMercury0c            => 'centimetre of mercury (0 ºC)',
            self::CentimetreOfWater4c              => 'centimetre of water (4 ºC)',
            self::FootOfWater392f                  => 'foot of water (39.2 ºF)',
            self::InchOfMercury32f                 => 'inch of mercury (32 ºF)',
            self::InchOfMercury60f                 => 'inch of mercury (60 ºF)',
            self::InchOfWater392f                  => 'inch of water (39.2 ºF)',
            self::InchOfWater60f                   => 'inch of water (60 ºF)',
            self::KipPerSquareInch                 => 'kip per square inch',
            self::PoundalPerSquareFoot             => 'poundal per square foot',
            self::OunceAvoirdupoisPerSquareInch    => 'ounce (avoirdupois) per square inch',
            self::ConventionalMetreOfWater         => 'conventional metre of water',
            self::MillimetresOfMercury             => 'millimetres of mercury',
            self::PoundForcePerSquareInch          => 'pound force per square inch',
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
            self::Pascal                           => '1',
            self::Decapascal                       => '10',
            self::Millipascal                      => '0.001',
            self::Gigapascal                       => '1000000000',
            self::Hectopascal                      => '100',
            self::Micropascal                      => '0.000001',
            self::Kilopascal                       => '1000',
            self::Megapascal                       => '1000000',
            self::Bar                              => '100000',
            self::Millibar                         => '100',
            self::NewtonPerSquareMetre             => '1',
            self::NewtonPerSquareMillimetre        => '1000000',
            self::KilogramForcePerSquareMetre      => '9.80665',
            self::Torr                             => '133.3224',
            self::PoundPerSquareInchAbsolute       => '6897.112776',
            self::ConventionalCentimetreOfWater    => '98.0665',
            self::ConventionalMillimetreOfWater    => '9.80665',
            self::InchOfMercury                    => '33220.4859',
            self::InchOfWater                      => '2443.56309',
            self::TechnicalAtmosphere              => '98066.5',
            self::StandardAtmosphere               => '101325',
            self::CentimetresOfMercury             => '1333.224',
            self::FootOfWater                      => '2989.067',
            self::FootOfMercury                    => '40636.66',
            self::GramForcePerSquareCentimetre     => '98.0665',
            self::KilogramForcePerSquareCentimetre => '98066.5',
            self::KilogramForcePerSquareMillimetre => '9806650',
            self::PoundForcePerSquareFoot          => '47.88026',
            self::KilopoundsForcePerSquareInch     => '6894757',
            self::CentimetreOfMercury0c            => '1333.22',
            self::CentimetreOfWater4c              => '98.0638',
            self::FootOfWater392f                  => '2988.98',
            self::InchOfMercury32f                 => '3386.38',
            self::InchOfMercury60f                 => '3376.85',
            self::InchOfWater392f                  => '249.082',
            self::InchOfWater60f                   => '248.84',
            self::KipPerSquareInch                 => '6894757',
            self::PoundalPerSquareFoot             => '1.488164',
            self::OunceAvoirdupoisPerSquareInch    => '431.0695485',
            self::ConventionalMetreOfWater         => '9806.65',
            self::MillimetresOfMercury             => '13332.24',
            self::PoundForcePerSquareInch          => '6894.757',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Pressure;
    }
}
