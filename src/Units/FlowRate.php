<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum FlowRate: string implements Unit
{
    case CubicCentimetrePerSecond    = '2J';
    case CubicFootPerHour            = '2K';
    case CubicFootPerMinute          = '2L';
    case MillilitrePerSecond         = '40';
    case MillilitrePerMinute         = '41';
    case KilolitrePerHour            = '4X';
    case BarrelUSPerMinute           = '5A';
    case BarrelUSPerDay              = 'B1';
    case CubicFootPerSecond          = 'E17';
    case LitrePerHour                = 'E32';
    case USGallonPerMinute           = 'G2';
    case ImperialGallonPerMinute     = 'G3';
    case GallonUSPerDay              = 'GB';
    case BarrelUKPetroleumPerMinute  = 'J58';
    case BarrelUKPetroleumPerDay     = 'J59';
    case BarrelUKPetroleumPerHour    = 'J60';
    case BarrelUKPetroleumPerSecond  = 'J61';
    case BarrelUSPetroleumPerHour    = 'J62';
    case BarrelUSPetroleumPerSecond  = 'J63';
    case BushelUKPerDay              = 'J64';
    case BushelUKPerHour             = 'J65';
    case BushelUKPerMinute           = 'J66';
    case BushelUKPerSecond           = 'J67';
    case BushelUSDryPerDay           = 'J68';
    case BushelUSDryPerHour          = 'J69';
    case BushelUSDryPerMinute        = 'J70';
    case BushelUSDryPerSecond        = 'J71';
    case CubicDecimetrePerDay        = 'J90';
    case CubicDecimetrePerMinute     = 'J92';
    case CubicDecimetrePerSecond     = 'J93';
    case OunceUKFluidPerDay          = 'J95';
    case OunceUKFluidPerHour         = 'J96';
    case OunceUKFluidPerMinute       = 'J97';
    case OunceUKFluidPerSecond       = 'J98';
    case OunceUSFluidPerDay          = 'J99';
    case OunceUSFluidPerHour         = 'K10';
    case OunceUSFluidPerMinute       = 'K11';
    case OunceUSFluidPerSecond       = 'K12';
    case CubicFootPerDay             = 'K22';
    case GallonUKPerDay              = 'K26';
    case GallonUKPerHour             = 'K27';
    case GallonUKPerSecond           = 'K28';
    case GallonUSLiquidPerSecond     = 'K30';
    case GillUKPerDay                = 'K32';
    case GillUKPerHour               = 'K33';
    case GillUKPerMinute             = 'K34';
    case GillUKPerSecond             = 'K35';
    case GillUSPerDay                = 'K36';
    case GillUSPerHour               = 'K37';
    case GillUSPerMinute             = 'K38';
    case GillUSPerSecond             = 'K39';
    case QuartUKLiquidPerDay         = 'K94';
    case QuartUKLiquidPerHour        = 'K95';
    case QuartUKLiquidPerMinute      = 'K96';
    case QuartUKLiquidPerSecond      = 'K97';
    case QuartUSLiquidPerDay         = 'K98';
    case QuartUSLiquidPerHour        = 'K99';
    case QuartUSLiquidPerMinute      = 'L10';
    case QuartUSLiquidPerSecond      = 'L11';
    case LitrePerMinute              = 'L2';
    case PeckUKPerDay                = 'L44';
    case PeckUKPerHour               = 'L45';
    case PeckUKPerMinute             = 'L46';
    case PeckUKPerSecond             = 'L47';
    case PeckUSDryPerDay             = 'L48';
    case PeckUSDryPerHour            = 'L49';
    case PeckUSDryPerMinute          = 'L50';
    case PeckUSDryPerSecond          = 'L51';
    case PintUKPerDay                = 'L53';
    case PintUKPerHour               = 'L54';
    case PintUKPerMinute             = 'L55';
    case PintUKPerSecond             = 'L56';
    case PintUSLiquidPerDay          = 'L57';
    case PintUSLiquidPerHour         = 'L58';
    case PintUSLiquidPerMinute       = 'L59';
    case PintUSLiquidPerSecond       = 'L60';
    case LitrePerDay                 = 'LD';
    case CubicYardPerDay             = 'M12';
    case CubicYardPerHour            = 'M13';
    case CubicYardPerMinute          = 'M15';
    case CubicYardPerSecond          = 'M16';
    case CubicMetrePerHour           = 'MQH';
    case CubicMetrePerSecond         = 'MQS';
    case StandardCubicMetrePerDay    = 'Q37';
    case StandardCubicMetrePerHour   = 'Q38';
    case NormalizedCubicMetrePerDay  = 'Q39';
    case NormalizedCubicMetrePerHour = 'Q40';
    case ThousandCubicMetrePerDay    = 'TQD';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::CubicCentimetrePerSecond    => 'cm³/s',
            self::CubicFootPerHour            => 'ft³/h',
            self::CubicFootPerMinute          => 'ft³/min',
            self::MillilitrePerSecond         => 'ml/s',
            self::MillilitrePerMinute         => 'ml/min',
            self::KilolitrePerHour            => 'kl/h',
            self::BarrelUSPerMinute           => 'barrel (US)/min',
            self::BarrelUSPerDay              => 'barrel (US)/d',
            self::CubicFootPerSecond          => 'ft³/s',
            self::LitrePerHour                => 'l/h',
            self::USGallonPerMinute           => 'gal (US) /min',
            self::ImperialGallonPerMinute     => 'gal (UK) /min',
            self::GallonUSPerDay              => 'gal (US)/d',
            self::BarrelUKPetroleumPerMinute  => 'bbl (UK liq.)/min',
            self::BarrelUKPetroleumPerDay     => 'bbl (UK liq.)/d',
            self::BarrelUKPetroleumPerHour    => 'bbl (UK liq.)/h',
            self::BarrelUKPetroleumPerSecond  => 'bbl (UK liq.)/s',
            self::BarrelUSPetroleumPerHour    => 'bbl (US)/h',
            self::BarrelUSPetroleumPerSecond  => 'bbl (US)/s',
            self::BushelUKPerDay              => 'bu (UK)/d',
            self::BushelUKPerHour             => 'bu (UK)/h',
            self::BushelUKPerMinute           => 'bu (UK)/min',
            self::BushelUKPerSecond           => 'bu (UK)/s',
            self::BushelUSDryPerDay           => 'bu (US dry)/d',
            self::BushelUSDryPerHour          => 'bu (US dry)/h',
            self::BushelUSDryPerMinute        => 'bu (US dry)/min',
            self::BushelUSDryPerSecond        => 'bu (US dry)/s',
            self::CubicDecimetrePerDay        => 'dm³/d',
            self::CubicDecimetrePerMinute     => 'dm³/min',
            self::CubicDecimetrePerSecond     => 'dm³/s',
            self::OunceUKFluidPerDay          => 'fl oz (UK)/d',
            self::OunceUKFluidPerHour         => 'fl oz (UK)/h',
            self::OunceUKFluidPerMinute       => 'fl oz (UK)/min',
            self::OunceUKFluidPerSecond       => 'fl oz (UK)/s',
            self::OunceUSFluidPerDay          => 'fl oz (US)/d',
            self::OunceUSFluidPerHour         => 'fl oz (US)/h',
            self::OunceUSFluidPerMinute       => 'fl oz (US)/min',
            self::OunceUSFluidPerSecond       => 'fl oz (US)/s',
            self::CubicFootPerDay             => 'ft³/d',
            self::GallonUKPerDay              => 'gal (UK)/d',
            self::GallonUKPerHour             => 'gal (UK)/h',
            self::GallonUKPerSecond           => 'gal (UK)/s',
            self::GallonUSLiquidPerSecond     => 'gal (US liq.)/s',
            self::GillUKPerDay                => 'gi (UK)/d',
            self::GillUKPerHour               => 'gi (UK)/h',
            self::GillUKPerMinute             => 'gi (UK)/min',
            self::GillUKPerSecond             => 'gi (UK)/s',
            self::GillUSPerDay                => 'gi (US)/d',
            self::GillUSPerHour               => 'gi (US)/h',
            self::GillUSPerMinute             => 'gi (US)/min',
            self::GillUSPerSecond             => 'gi (US)/s',
            self::QuartUKLiquidPerDay         => 'qt (UK liq.)/d',
            self::QuartUKLiquidPerHour        => 'qt (UK liq.)/h',
            self::QuartUKLiquidPerMinute      => 'qt (UK liq.)/min',
            self::QuartUKLiquidPerSecond      => 'qt (UK liq.)/s',
            self::QuartUSLiquidPerDay         => 'qt (US liq.)/d',
            self::QuartUSLiquidPerHour        => 'qt (US liq.)/h',
            self::QuartUSLiquidPerMinute      => 'qt (US liq.)/min',
            self::QuartUSLiquidPerSecond      => 'qt (US liq.)/s',
            self::LitrePerMinute              => 'l/min',
            self::PeckUKPerDay                => 'pk (UK)/d',
            self::PeckUKPerHour               => 'pk (UK)/h',
            self::PeckUKPerMinute             => 'pk (UK)/min',
            self::PeckUKPerSecond             => 'pk (UK)/s',
            self::PeckUSDryPerDay             => 'pk (US dry)/d',
            self::PeckUSDryPerHour            => 'pk (US dry)/h',
            self::PeckUSDryPerMinute          => 'pk (US dry)/min',
            self::PeckUSDryPerSecond          => 'pk (US dry)/s',
            self::PintUKPerDay                => 'pt (UK)/d',
            self::PintUKPerHour               => 'pt (UK)/h',
            self::PintUKPerMinute             => 'pt (UK)/min',
            self::PintUKPerSecond             => 'pt (UK)/s',
            self::PintUSLiquidPerDay          => 'pt (US liq.)/d',
            self::PintUSLiquidPerHour         => 'pt (US liq.)/h',
            self::PintUSLiquidPerMinute       => 'pt (US liq.)/min',
            self::PintUSLiquidPerSecond       => 'pt (US liq.)/s',
            self::LitrePerDay                 => 'l/d',
            self::CubicYardPerDay             => 'yd³/d',
            self::CubicYardPerHour            => 'yd³/h',
            self::CubicYardPerMinute          => 'yd³/min',
            self::CubicYardPerSecond          => 'yd³/s',
            self::CubicMetrePerHour           => 'm³/h',
            self::CubicMetrePerSecond         => 'm³/s',
            self::StandardCubicMetrePerDay    => 'std.m³/d',
            self::StandardCubicMetrePerHour   => 'std.m³/h',
            self::NormalizedCubicMetrePerDay  => 'norm.m³/d',
            self::NormalizedCubicMetrePerHour => 'norm.m³/h',
            self::ThousandCubicMetrePerDay    => 'thousand m³/d',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::CubicCentimetrePerSecond    => 'cubic centimetre per second',
            self::CubicFootPerHour            => 'cubic foot per hour',
            self::CubicFootPerMinute          => 'cubic foot per minute',
            self::MillilitrePerSecond         => 'millilitre per second',
            self::MillilitrePerMinute         => 'millilitre per minute',
            self::KilolitrePerHour            => 'kilolitre per hour',
            self::BarrelUSPerMinute           => 'barrel (US) per minute',
            self::BarrelUSPerDay              => 'barrel (US) per day',
            self::CubicFootPerSecond          => 'cubic foot per second',
            self::LitrePerHour                => 'litre per hour',
            self::USGallonPerMinute           => 'US gallon per minute',
            self::ImperialGallonPerMinute     => 'Imperial gallon per minute',
            self::GallonUSPerDay              => 'gallon (US) per day',
            self::BarrelUKPetroleumPerMinute  => 'barrel (UK petroleum) per minute',
            self::BarrelUKPetroleumPerDay     => 'barrel (UK petroleum) per day',
            self::BarrelUKPetroleumPerHour    => 'barrel (UK petroleum) per hour',
            self::BarrelUKPetroleumPerSecond  => 'barrel (UK petroleum) per second',
            self::BarrelUSPetroleumPerHour    => 'barrel (US petroleum) per hour',
            self::BarrelUSPetroleumPerSecond  => 'barrel (US petroleum) per second',
            self::BushelUKPerDay              => 'bushel (UK) per day',
            self::BushelUKPerHour             => 'bushel (UK) per hour',
            self::BushelUKPerMinute           => 'bushel (UK) per minute',
            self::BushelUKPerSecond           => 'bushel (UK) per second',
            self::BushelUSDryPerDay           => 'bushel (US dry) per day',
            self::BushelUSDryPerHour          => 'bushel (US dry) per hour',
            self::BushelUSDryPerMinute        => 'bushel (US dry) per minute',
            self::BushelUSDryPerSecond        => 'bushel (US dry) per second',
            self::CubicDecimetrePerDay        => 'cubic decimetre per day',
            self::CubicDecimetrePerMinute     => 'cubic decimetre per minute',
            self::CubicDecimetrePerSecond     => 'cubic decimetre per second',
            self::OunceUKFluidPerDay          => 'ounce (UK fluid) per day',
            self::OunceUKFluidPerHour         => 'ounce (UK fluid) per hour',
            self::OunceUKFluidPerMinute       => 'ounce (UK fluid) per minute',
            self::OunceUKFluidPerSecond       => 'ounce (UK fluid) per second',
            self::OunceUSFluidPerDay          => 'ounce (US fluid) per day',
            self::OunceUSFluidPerHour         => 'ounce (US fluid) per hour',
            self::OunceUSFluidPerMinute       => 'ounce (US fluid) per minute',
            self::OunceUSFluidPerSecond       => 'ounce (US fluid) per second',
            self::CubicFootPerDay             => 'cubic foot per day',
            self::GallonUKPerDay              => 'gallon (UK) per day',
            self::GallonUKPerHour             => 'gallon (UK) per hour',
            self::GallonUKPerSecond           => 'gallon (UK) per second',
            self::GallonUSLiquidPerSecond     => 'gallon (US liquid) per second',
            self::GillUKPerDay                => 'gill (UK) per day',
            self::GillUKPerHour               => 'gill (UK) per hour',
            self::GillUKPerMinute             => 'gill (UK) per minute',
            self::GillUKPerSecond             => 'gill (UK) per second',
            self::GillUSPerDay                => 'gill (US) per day',
            self::GillUSPerHour               => 'gill (US) per hour',
            self::GillUSPerMinute             => 'gill (US) per minute',
            self::GillUSPerSecond             => 'gill (US) per second',
            self::QuartUKLiquidPerDay         => 'quart (UK liquid) per day',
            self::QuartUKLiquidPerHour        => 'quart (UK liquid) per hour',
            self::QuartUKLiquidPerMinute      => 'quart (UK liquid) per minute',
            self::QuartUKLiquidPerSecond      => 'quart (UK liquid) per second',
            self::QuartUSLiquidPerDay         => 'quart (US liquid) per day',
            self::QuartUSLiquidPerHour        => 'quart (US liquid) per hour',
            self::QuartUSLiquidPerMinute      => 'quart (US liquid) per minute',
            self::QuartUSLiquidPerSecond      => 'quart (US liquid) per second',
            self::LitrePerMinute              => 'litre per minute',
            self::PeckUKPerDay                => 'peck (UK) per day',
            self::PeckUKPerHour               => 'peck (UK) per hour',
            self::PeckUKPerMinute             => 'peck (UK) per minute',
            self::PeckUKPerSecond             => 'peck (UK) per second',
            self::PeckUSDryPerDay             => 'peck (US dry) per day',
            self::PeckUSDryPerHour            => 'peck (US dry) per hour',
            self::PeckUSDryPerMinute          => 'peck (US dry) per minute',
            self::PeckUSDryPerSecond          => 'peck (US dry) per second',
            self::PintUKPerDay                => 'pint (UK) per day',
            self::PintUKPerHour               => 'pint (UK) per hour',
            self::PintUKPerMinute             => 'pint (UK) per minute',
            self::PintUKPerSecond             => 'pint (UK) per second',
            self::PintUSLiquidPerDay          => 'pint (US liquid) per day',
            self::PintUSLiquidPerHour         => 'pint (US liquid) per hour',
            self::PintUSLiquidPerMinute       => 'pint (US liquid) per minute',
            self::PintUSLiquidPerSecond       => 'pint (US liquid) per second',
            self::LitrePerDay                 => 'litre per day',
            self::CubicYardPerDay             => 'cubic yard per day',
            self::CubicYardPerHour            => 'cubic yard per hour',
            self::CubicYardPerMinute          => 'cubic yard per minute',
            self::CubicYardPerSecond          => 'cubic yard per second',
            self::CubicMetrePerHour           => 'cubic metre per hour',
            self::CubicMetrePerSecond         => 'cubic metre per second',
            self::StandardCubicMetrePerDay    => 'Standard cubic metre per day',
            self::StandardCubicMetrePerHour   => 'Standard cubic metre per hour',
            self::NormalizedCubicMetrePerDay  => 'Normalized cubic metre per day',
            self::NormalizedCubicMetrePerHour => 'Normalized cubic metre per hour',
            self::ThousandCubicMetrePerDay    => 'thousand cubic metre per day',
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
            self::CubicCentimetrePerSecond    => '0.000001',
            self::CubicFootPerHour            => '0.00000786579',
            self::CubicFootPerMinute          => '0.0004719474',
            self::MillilitrePerSecond         => '0.000001',
            self::MillilitrePerMinute         => '0.0000000166667',
            self::KilolitrePerHour            => '0.000277778',
            self::BarrelUSPerMinute           => '0.00264979',
            self::BarrelUSPerDay              => '0.00000184013',
            self::CubicFootPerSecond          => '0.02831685',
            self::LitrePerHour                => '0.000000277778',
            self::USGallonPerMinute           => '0.0000630902',
            self::ImperialGallonPerMinute     => '0.0000757682',
            self::GallonUSPerDay              => '0.00000004381264',
            self::BarrelUKPetroleumPerMinute  => '2.651886',
            self::BarrelUKPetroleumPerDay     => '0.0000018415874',
            self::BarrelUKPetroleumPerHour    => '0.0000441981',
            self::BarrelUKPetroleumPerSecond  => '0.15911315',
            self::BarrelUSPetroleumPerHour    => '0.00004416314',
            self::BarrelUSPetroleumPerSecond  => '0.1589873',
            self::BushelUKPerDay              => '0.0000004209343',
            self::BushelUKPerHour             => '0.00001010242',
            self::BushelUKPerMinute           => '0.0006061453',
            self::BushelUKPerSecond           => '0.03636872',
            self::BushelUSDryPerDay           => '0.0000004078596',
            self::BushelUSDryPerHour          => '0.000009788631',
            self::BushelUSDryPerMinute        => '0.0005873178',
            self::BushelUSDryPerSecond        => '0.03523907',
            self::CubicDecimetrePerDay        => '0.0000000115741',
            self::CubicDecimetrePerMinute     => '0.0000166667',
            self::CubicDecimetrePerSecond     => '0.001',
            self::OunceUKFluidPerDay          => '0.0000000003288549',
            self::OunceUKFluidPerHour         => '0.000000007892517',
            self::OunceUKFluidPerMinute       => '0.000000473551',
            self::OunceUKFluidPerSecond       => '0.00002841306',
            self::OunceUSFluidPerDay          => '0.0000000003422862',
            self::OunceUSFluidPerHour         => '0.000000008214869',
            self::OunceUSFluidPerMinute       => '0.0000004928922',
            self::OunceUSFluidPerSecond       => '0.00002957353',
            self::CubicFootPerDay             => '0.0000003277413',
            self::GallonUKPerDay              => '0.00000005261678',
            self::GallonUKPerHour             => '0.000001262803',
            self::GallonUKPerSecond           => '0.00454609',
            self::GallonUSLiquidPerSecond     => '0.003785412',
            self::GillUKPerDay                => '0.00001644274',
            self::GillUKPerHour               => '0.00000003946258',
            self::GillUKPerMinute             => '0.02367755',
            self::GillUKPerSecond             => '0.0001420653',
            self::GillUSPerDay                => '0.000000001369145',
            self::GillUSPerHour               => '0.00000003285947',
            self::GillUSPerMinute             => '0.000001971568',
            self::GillUSPerSecond             => '0.0001182941',
            self::QuartUKLiquidPerDay         => '0.0000000131542',
            self::QuartUKLiquidPerHour        => '0.0000003157008',
            self::QuartUKLiquidPerMinute      => '0.00001894205',
            self::QuartUKLiquidPerSecond      => '0.001136523',
            self::QuartUSLiquidPerDay         => '0.00000001095316',
            self::QuartUSLiquidPerHour        => '0.0000002628758',
            self::QuartUSLiquidPerMinute      => '0.00001577255',
            self::QuartUSLiquidPerSecond      => '0.0009463529',
            self::LitrePerMinute              => '0.0000166667',
            self::PeckUKPerDay                => '0.0000001052336',
            self::PeckUKPerHour               => '0.000002525606',
            self::PeckUKPerMinute             => '0.00015153635',
            self::PeckUKPerSecond             => '0.009092181',
            self::PeckUSDryPerDay             => '0.0000001019649',
            self::PeckUSDryPerHour            => '0.000002447158',
            self::PeckUSDryPerMinute          => '0.0001468295',
            self::PeckUSDryPerSecond          => '0.008809768',
            self::PintUKPerDay                => '0.000000006577098',
            self::PintUKPerHour               => '0.0000001578504',
            self::PintUKPerMinute             => '0.000009471022',
            self::PintUKPerSecond             => '0.0005682613',
            self::PintUSLiquidPerDay          => '0.00000000547658',
            self::PintUSLiquidPerHour         => '0.0000001314379',
            self::PintUSLiquidPerMinute       => '0.000007886275',
            self::PintUSLiquidPerSecond       => '0.0004731765',
            self::LitrePerDay                 => '0.0000000115741',
            self::CubicYardPerDay             => '0.000008849015',
            self::CubicYardPerHour            => '0.0002123764',
            self::CubicYardPerMinute          => '0.01274258',
            self::CubicYardPerSecond          => '0.7645549',
            self::CubicMetrePerHour           => '0.000277778',
            self::CubicMetrePerSecond         => '1',
            self::StandardCubicMetrePerDay    => '0.0000115741',
            self::StandardCubicMetrePerHour   => '0.000277778',
            self::NormalizedCubicMetrePerDay  => '0.0000115741',
            self::NormalizedCubicMetrePerHour => '0.000277778',
            self::ThousandCubicMetrePerDay    => '0.0115741',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::FlowRate;
    }
}
