<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Density: string implements Unit
{
    case KilogramPerCubicMetre        = 'KMQ';
    case GramPerCubicCentimetre       = '23';
    case TonnePerCubicMetre           = 'D41';
    case GramPerMillilitre            = 'GJ';
    case KilogramPerLitre             = 'B35';
    case GramPerLitre                 = 'GL';
    case GramPerCubicMetre            = 'A93';
    case MilligramPerCubicMetre       = 'GP';
    case MegagramPerCubicMetre        = 'B72';
    case KilogramPerCubicDecimetre    = 'B34';
    case MicrogramPerLitre            = 'H29';
    case MilligramPerLitre            = 'M1';
    case MicrogramPerCubicMetre       = 'GQ';
    case GramPerCubicDecimetre        = 'F23';
    case KilogramPerCubicCentimetre   = 'G31';
    case PoundPerCubicFoot            = '87';
    case PoundPerGallonUS             = 'GE';
    case PoundPerCubicInch            = 'LA';
    case OunceAvoirdupoisPerCubicYard = 'G32';
    case GrainPerGallonUS             = 'K41';
    case PoundAvoirdupoisPerGallonUK  = 'K71';
    case PoundPerCubicYard            = 'K84';
    case OunceAvoirdupoisPerGallonUK  = 'L37';
    case OunceAvoirdupoisPerGallonUS  = 'L38';
    case OunceAvoirdupoisPerCubicInch = 'L39';
    case SlugPerCubicFoot             = 'L65';
    case TonUKLongPerCubicYard        = 'L92';
    case TonUSShortPerCubicYard       = 'L93';

    public function symbol(): string
    {
        return match ($this) {
            self::KilogramPerCubicMetre        => 'kg/m³',
            self::GramPerCubicCentimetre       => 'g/cm³',
            self::TonnePerCubicMetre           => 't/m³',
            self::GramPerMillilitre            => 'g/ml',
            self::KilogramPerLitre             => 'kg/l or kg/L',
            self::GramPerLitre                 => 'g/l',
            self::GramPerCubicMetre            => 'g/m³',
            self::MilligramPerCubicMetre       => 'mg/m³',
            self::MegagramPerCubicMetre        => 'Mg/m³',
            self::KilogramPerCubicDecimetre    => 'kg/dm³',
            self::MicrogramPerLitre            => 'µg/l',
            self::MilligramPerLitre            => 'mg/l',
            self::MicrogramPerCubicMetre       => 'µg/m³',
            self::GramPerCubicDecimetre        => 'g/dm³',
            self::KilogramPerCubicCentimetre   => 'kg/cm³',
            self::PoundPerCubicFoot            => 'lb/ft³',
            self::PoundPerGallonUS             => 'lb/gal (US)',
            self::PoundPerCubicInch            => 'lb/in³',
            self::OunceAvoirdupoisPerCubicYard => 'oz/yd³',
            self::GrainPerGallonUS             => 'gr/gal (US)',
            self::PoundAvoirdupoisPerGallonUK  => 'lb/gal (UK)',
            self::PoundPerCubicYard            => 'lb/yd³',
            self::OunceAvoirdupoisPerGallonUK  => 'oz/gal (UK)',
            self::OunceAvoirdupoisPerGallonUS  => 'oz/gal (US)',
            self::OunceAvoirdupoisPerCubicInch => 'oz/in³',
            self::SlugPerCubicFoot             => 'slug/ft³',
            self::TonUKLongPerCubicYard        => 'ton.l/yd³ (UK)',
            self::TonUSShortPerCubicYard       => 'ton.s/yd³ (US)',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::KilogramPerCubicMetre        => 'kilogram per cubic metre',
            self::GramPerCubicCentimetre       => 'gram per cubic centimetre',
            self::TonnePerCubicMetre           => 'tonne per cubic metre',
            self::GramPerMillilitre            => 'gram per millilitre',
            self::KilogramPerLitre             => 'kilogram per litre',
            self::GramPerLitre                 => 'gram per litre',
            self::GramPerCubicMetre            => 'gram per cubic metre',
            self::MilligramPerCubicMetre       => 'milligram per cubic metre',
            self::MegagramPerCubicMetre        => 'megagram per cubic metre',
            self::KilogramPerCubicDecimetre    => 'kilogram per cubic decimetre',
            self::MicrogramPerLitre            => 'microgram per litre',
            self::MilligramPerLitre            => 'milligram per litre',
            self::MicrogramPerCubicMetre       => 'microgram per cubic metre',
            self::GramPerCubicDecimetre        => 'gram per cubic decimetre',
            self::KilogramPerCubicCentimetre   => 'kilogram per cubic centimetre',
            self::PoundPerCubicFoot            => 'pound per cubic foot',
            self::PoundPerGallonUS             => 'pound per gallon (US)',
            self::PoundPerCubicInch            => 'pound per cubic inch',
            self::OunceAvoirdupoisPerCubicYard => 'ounce (avoirdupois) per cubic yard',
            self::GrainPerGallonUS             => 'grain per gallon (US)',
            self::PoundAvoirdupoisPerGallonUK  => 'pound (avoirdupois) per gallon (UK)',
            self::PoundPerCubicYard            => 'pound per cubic yard',
            self::OunceAvoirdupoisPerGallonUK  => 'ounce (avoirdupois) per gallon (UK)',
            self::OunceAvoirdupoisPerGallonUS  => 'ounce (avoirdupois) per gallon (US)',
            self::OunceAvoirdupoisPerCubicInch => 'ounce (avoirdupois) per cubic inch',
            self::SlugPerCubicFoot             => 'slug per cubic foot',
            self::TonUKLongPerCubicYard        => 'ton (UK long) per cubic yard',
            self::TonUSShortPerCubicYard       => 'ton (US short) per cubic yard',
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
            self::KilogramPerCubicMetre        => '1',
            self::GramPerCubicCentimetre       => '1000',
            self::TonnePerCubicMetre           => '1000',
            self::GramPerMillilitre            => '1000',
            self::KilogramPerLitre             => '1000',
            self::GramPerLitre                 => '1',
            self::GramPerCubicMetre            => '0.001',
            self::MilligramPerCubicMetre       => '0.000001',
            self::MegagramPerCubicMetre        => '1000',
            self::KilogramPerCubicDecimetre    => '1000',
            self::MicrogramPerLitre            => '0.000001',
            self::MilligramPerLitre            => '0.001',
            self::MicrogramPerCubicMetre       => '0.000000001',
            self::GramPerCubicDecimetre        => '1',
            self::KilogramPerCubicCentimetre   => '1000000',
            self::PoundPerCubicFoot            => '16.01846',
            self::PoundPerGallonUS             => '119.8264',
            self::PoundPerCubicInch            => '27679.9',
            self::OunceAvoirdupoisPerCubicYard => '0.0370798',
            self::GrainPerGallonUS             => '0.01711806',
            self::PoundAvoirdupoisPerGallonUK  => '99.77637',
            self::PoundPerCubicYard            => '0.5932764',
            self::OunceAvoirdupoisPerGallonUK  => '6.236023',
            self::OunceAvoirdupoisPerGallonUS  => '7.489152',
            self::OunceAvoirdupoisPerCubicInch => '1729.994',
            self::SlugPerCubicFoot             => '515.3788',
            self::TonUKLongPerCubicYard        => '1328.939',
            self::TonUSShortPerCubicYard       => '1186.553',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Density;
    }
}
