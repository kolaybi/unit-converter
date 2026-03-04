<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Volume: string implements Unit
{
    case CubicMetre                  = 'MTQ';
    case Megalitre                   = 'MAL';
    case Litre                       = 'LTR';
    case CubicMillimetre             = 'MMQ';
    case CubicCentimetre             = 'CMQ';
    case CubicDecimetre              = 'DMQ';
    case Hectolitre                  = 'HLT';
    case CubicDecametre              = 'DMA';
    case CubicHectometre             = 'H19';
    case CubicKilometre              = 'H20';
    case Decilitre                   = 'DLT';
    case Centilitre                  = 'CLT';
    case Millilitre                  = 'MLT';
    case Microlitre                  = '4G';
    case Nanolitre                   = 'Q34';
    case Picolitre                   = 'Q33';
    case Femtolitre                  = 'Q32';
    case Kilolitre                   = 'K6';
    case ThousandLitre               = 'D40';
    case Decalitre                   = 'A44';
    case CubicInch                   = 'INQ';
    case CubicFoot                   = 'FTQ';
    case CubicYard                   = 'YDQ';
    case GallonUK                    = 'GLI';
    case GallonUS                    = 'GLL';
    case PintUS                      = 'PT';
    case PintUK                      = 'PTI';
    case QuartUK                     = 'QTI';
    case LiquidPintUS                = 'PTL';
    case LiquidQuartUS               = 'QTL';
    case DryPintUS                   = 'PTD';
    case FluidOunceUK                = 'OZI';
    case QuartUS                     = 'QT';
    case BarrelUKPetroleum           = 'J57';
    case PeckUK                      = 'L43';
    case PintUSDry                   = 'L61';
    case QuartUSDry                  = 'L62';
    case TonUKShipping               = 'L84';
    case TonUSShipping               = 'L86';
    case FluidOunceUS                = 'OZA';
    case BushelUK                    = 'BUI';
    case BushelUS                    = 'BUA';
    case BarrelUS                    = 'BLL';
    case DryBarrelUS                 = 'BLD';
    case DryGallonUS                 = 'GLD';
    case DryQuartUS                  = 'QTD';
    case Stere                       = 'G26';
    case CupunitOfVolume             = 'G21';
    case TablespoonUS                = 'G24';
    case TeaspoonUS                  = 'G25';
    case Peck                        = 'G23';
    case AcreFootBasedOnUsSurveyFoot = 'M67';
    case Cord128Ft                   = 'M68';
    case CubicMileUKStatute          = 'M69';
    case TonRegister                 = 'M70';
    case BoardFoot                   = 'BFT';
    case HundredBoardFoot            = 'BP';
    case StandardCubicFoot           = '5I';
    case GillUS                      = 'GIA';
    case GillUK                      = 'GII';
    case NormalisedCubicMetre        = 'NM3';
    case ThousandCubicMetre          = 'R9';
    case StandardCubicMetre          = 'SM3';
    case ThousandGallonUS            = 'T6';
    case Cord                        = 'WCD';
    case Standard                    = 'WSD';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::CubicMetre                  => 'm³',
            self::Megalitre                   => 'Ml',
            self::Litre                       => 'l',
            self::CubicMillimetre             => 'mm³',
            self::CubicCentimetre             => 'cm³',
            self::CubicDecimetre              => 'dm³',
            self::Hectolitre                  => 'hl',
            self::CubicDecametre              => 'dam³',
            self::CubicHectometre             => 'hm³',
            self::CubicKilometre              => 'km³',
            self::Decilitre                   => 'dl',
            self::Centilitre                  => 'cl',
            self::Millilitre                  => 'ml',
            self::Microlitre                  => 'µl',
            self::Nanolitre                   => 'nl',
            self::Picolitre                   => 'pl',
            self::Femtolitre                  => 'fl',
            self::Kilolitre                   => 'kl',
            self::ThousandLitre               => 'kl',
            self::Decalitre                   => 'dal',
            self::CubicInch                   => 'in³',
            self::CubicFoot                   => 'ft³',
            self::CubicYard                   => 'yd³',
            self::GallonUK                    => 'gal (UK)',
            self::GallonUS                    => 'gal (US)',
            self::PintUS                      => 'pt (US)',
            self::PintUK                      => 'pt (UK)',
            self::QuartUK                     => 'qt (UK)',
            self::LiquidPintUS                => 'liq pt (US)',
            self::LiquidQuartUS               => 'liq qt (US)',
            self::DryPintUS                   => 'dry pt (US)',
            self::FluidOunceUK                => 'fl oz (UK)',
            self::QuartUS                     => 'qt (US)',
            self::BarrelUKPetroleum           => 'bbl (UK liq.)',
            self::PeckUK                      => 'pk (UK)',
            self::PintUSDry                   => 'pt (US dry)',
            self::QuartUSDry                  => 'qt (US dry)',
            self::TonUKShipping               => 'British shipping ton',
            self::TonUSShipping               => '(US) shipping ton',
            self::FluidOunceUS                => 'fl oz (US)',
            self::BushelUK                    => 'bushel (UK)',
            self::BushelUS                    => 'bu (US)',
            self::BarrelUS                    => 'barrel (US)',
            self::DryBarrelUS                 => 'bbl (US)',
            self::DryGallonUS                 => 'dry gal (US)',
            self::DryQuartUS                  => 'dry qt (US)',
            self::Stere                       => 'st',
            self::CupunitOfVolume             => 'cup (US)',
            self::TablespoonUS                => 'tablespoon (US)',
            self::TeaspoonUS                  => 'teaspoon (US)',
            self::Peck                        => 'pk (US)',
            self::AcreFootBasedOnUsSurveyFoot => 'acre-ft (US survey)',
            self::Cord128Ft                   => 'cord',
            self::CubicMileUKStatute          => 'mi³',
            self::TonRegister                 => 'RT',
            self::BoardFoot                   => 'fbm',
            self::HundredBoardFoot            => 'hundred fbm',
            self::StandardCubicFoot           => 'std',
            self::GillUS                      => 'gi (US)',
            self::GillUK                      => 'gi (UK)',
            self::NormalisedCubicMetre        => 'NM3',
            self::ThousandCubicMetre          => 'R9',
            self::StandardCubicMetre          => 'SM3',
            self::ThousandGallonUS            => 'T6',
            self::Cord                        => 'WCD',
            self::Standard                    => 'std',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::CubicMetre                  => 'cubic metre',
            self::Megalitre                   => 'megalitre',
            self::Litre                       => 'litre',
            self::CubicMillimetre             => 'cubic millimetre',
            self::CubicCentimetre             => 'cubic centimetre',
            self::CubicDecimetre              => 'cubic decimetre',
            self::Hectolitre                  => 'hectolitre',
            self::CubicDecametre              => 'cubic decametre',
            self::CubicHectometre             => 'cubic hectometre',
            self::CubicKilometre              => 'cubic kilometre',
            self::Decilitre                   => 'decilitre',
            self::Centilitre                  => 'centilitre',
            self::Millilitre                  => 'millilitre',
            self::Microlitre                  => 'microlitre',
            self::Nanolitre                   => 'nanolitre',
            self::Picolitre                   => 'picolitre',
            self::Femtolitre                  => 'femtolitre',
            self::Kilolitre                   => 'kilolitre',
            self::ThousandLitre               => 'thousand litre',
            self::Decalitre                   => 'decalitre',
            self::CubicInch                   => 'cubic inch',
            self::CubicFoot                   => 'cubic foot',
            self::CubicYard                   => 'cubic yard',
            self::GallonUK                    => 'gallon (UK)',
            self::GallonUS                    => 'gallon (US)',
            self::PintUS                      => 'pint (US)',
            self::PintUK                      => 'pint (UK)',
            self::QuartUK                     => 'quart (UK)',
            self::LiquidPintUS                => 'liquid pint (US)',
            self::LiquidQuartUS               => 'liquid quart (US)',
            self::DryPintUS                   => 'dry pint (US)',
            self::FluidOunceUK                => 'fluid ounce (UK)',
            self::QuartUS                     => 'quart (US)',
            self::BarrelUKPetroleum           => 'barrel (UK petroleum)',
            self::PeckUK                      => 'peck (UK)',
            self::PintUSDry                   => 'pint (US dry)',
            self::QuartUSDry                  => 'quart (US dry)',
            self::TonUKShipping               => 'ton (UK shipping)',
            self::TonUSShipping               => 'ton (US shipping)',
            self::FluidOunceUS                => 'fluid ounce (US)',
            self::BushelUK                    => 'bushel (UK)',
            self::BushelUS                    => 'bushel (US)',
            self::BarrelUS                    => 'barrel (US)',
            self::DryBarrelUS                 => 'dry barrel (US)',
            self::DryGallonUS                 => 'dry gallon (US)',
            self::DryQuartUS                  => 'dry quart (US)',
            self::Stere                       => 'stere',
            self::CupunitOfVolume             => 'cup [unit of volume]',
            self::TablespoonUS                => 'tablespoon (US)',
            self::TeaspoonUS                  => 'teaspoon (US)',
            self::Peck                        => 'peck',
            self::AcreFootBasedOnUsSurveyFoot => 'acre-foot (based on U.S. survey foot)',
            self::Cord128Ft                   => 'cord (128 ft³)',
            self::CubicMileUKStatute          => 'cubic mile (UK statute)',
            self::TonRegister                 => 'ton. register ',
            self::BoardFoot                   => 'board foot',
            self::HundredBoardFoot            => 'hundred board foot',
            self::StandardCubicFoot           => 'standard cubic foot',
            self::GillUS                      => 'gill (US)',
            self::GillUK                      => 'gill (UK)',
            self::NormalisedCubicMetre        => 'Normalised cubic metre',
            self::ThousandCubicMetre          => 'thousand cubic metre',
            self::StandardCubicMetre          => 'Standard cubic metre',
            self::ThousandGallonUS            => 'thousand gallon (US)',
            self::Cord                        => 'cord',
            self::Standard                    => 'standard',
        };
    }

    /**
     * @return list<string>
     */
    public function aliases(): array
    {
        $base = [$this->value, $this->symbol(), $this->label()];

        return match ($this) {
            self::Litre  => [...$base, 'lt'],
            self::PintUS => [...$base, 'pnt'],
            default      => $base,
        };
    }

    public function multiplier(): string
    {
        return match ($this) {
            self::CubicMetre                  => '1',
            self::Megalitre                   => '1000',
            self::Litre                       => '0.001',
            self::CubicMillimetre             => '0.000000001',
            self::CubicCentimetre             => '0.000001',
            self::CubicDecimetre              => '0.001',
            self::Hectolitre                  => '0.1',
            self::CubicDecametre              => '1000',
            self::CubicHectometre             => '1000000',
            self::CubicKilometre              => '1000000000',
            self::Decilitre                   => '0.0001',
            self::Centilitre                  => '0.00001',
            self::Millilitre                  => '0.000001',
            self::Microlitre                  => '0.000000001',
            self::Nanolitre                   => '0.000000000001',
            self::Picolitre                   => '0.000000000000001',
            self::Femtolitre                  => '0.000000000000000001',
            self::Kilolitre                   => '1',
            self::ThousandLitre               => '1',
            self::Decalitre                   => '0.01',
            self::CubicInch                   => '0.000016387064',
            self::CubicFoot                   => '0.02831684659',
            self::CubicYard                   => '0.764555',
            self::GallonUK                    => '0.004546092',
            self::GallonUS                    => '0.003785412',
            self::PintUS                      => '0.000473176',
            self::PintUK                      => '0.000568261',
            self::QuartUK                     => '0.0011365225',
            self::LiquidPintUS                => '0.0004731765',
            self::LiquidQuartUS               => '0.0009463529',
            self::DryPintUS                   => '0.0005506105',
            self::FluidOunceUK                => '0.00002841306',
            self::QuartUS                     => '0.0009463529',
            self::BarrelUKPetroleum           => '0.15911315',
            self::PeckUK                      => '0.009092181',
            self::PintUSDry                   => '0.0005506105',
            self::QuartUSDry                  => '0.001101221',
            self::TonUKShipping               => '1.1893',
            self::TonUSShipping               => '1.1326',
            self::FluidOunceUS                => '0.00002957353',
            self::BushelUK                    => '0.03636872',
            self::BushelUS                    => '0.03523907',
            self::BarrelUS                    => '0.1589873',
            self::DryBarrelUS                 => '0.115627',
            self::DryGallonUS                 => '0.004404884',
            self::DryQuartUS                  => '0.001101221',
            self::Stere                       => '1',
            self::CupunitOfVolume             => '0.0002365882',
            self::TablespoonUS                => '0.00001478676',
            self::TeaspoonUS                  => '0.000004928922',
            self::Peck                        => '0.008809768',
            self::AcreFootBasedOnUsSurveyFoot => '1233.489',
            self::Cord128Ft                   => '3.624556',
            self::CubicMileUKStatute          => '4168182000',
            self::TonRegister                 => '2.831685',
            self::BoardFoot                   => '3.6245563638',
            self::HundredBoardFoot            => '362.45563638',
            self::StandardCubicFoot           => '4.672',
            self::GillUS                      => '0.0001182941',
            self::GillUK                      => '0.0001420653',
            self::NormalisedCubicMetre        => '1',
            self::ThousandCubicMetre          => '1000',
            self::StandardCubicMetre          => '1',
            self::ThousandGallonUS            => '3.785412',
            self::Cord                        => '3.63',
            self::Standard                    => '4.672',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Volume;
    }
}
