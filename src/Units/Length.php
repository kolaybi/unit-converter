<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Length: string implements Unit
{
    case Metre                    = 'MTR';
    case Angstrom                 = 'A11';
    case Femtometre               = 'A71';
    case Nanometre                = 'C45';
    case Micrometre               = '4H';
    case AstronomicalUnit         = 'A12';
    case Decimetre                = 'DMT';
    case Centimetre               = 'CMT';
    case Millimetre               = 'MMT';
    case Inch                     = 'INH';
    case Foot                     = 'FOT';
    case Yard                     = 'YRD';
    case NauticalMile             = 'NMI';
    case Decametre                = 'A45';
    case Hectometre               = 'HMT';
    case Kilometre                = 'KMT';
    case LightYear                = 'B57';
    case Fathom                   = 'AK';
    case Furlong                  = 'M50';
    case ChainBasedOnUSSurveyFoot = 'M49';
    case GuntersChain             = 'X1';
    case FootUSSurvey             = 'M51';
    case HundredFootLinear        = 'HL';
    case LinearFoot               = 'LF';
    case Link                     = 'LK';
    case LinearMetre              = 'LM';
    case MileStatuteMile          = 'SMI';
    case Picometre                = 'C52';
    case Parsec                   = 'C63';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Metre                    => 'm',
            self::Angstrom                 => 'Å',
            self::Femtometre               => 'fm',
            self::Nanometre                => 'nm',
            self::Micrometre               => 'µm',
            self::AstronomicalUnit         => 'ua',
            self::Decimetre                => 'dm',
            self::Centimetre               => 'cm',
            self::Millimetre               => 'mm',
            self::Inch                     => 'in',
            self::Foot                     => 'ft',
            self::Yard                     => 'yd',
            self::NauticalMile             => 'n mile',
            self::Decametre                => 'dam',
            self::Hectometre               => 'hm',
            self::Kilometre                => 'km',
            self::LightYear                => 'ly',
            self::Fathom                   => 'fth',
            self::Furlong                  => 'fur',
            self::ChainBasedOnUSSurveyFoot => 'ch (US survey)',
            self::GuntersChain             => 'ch (UK)',
            self::FootUSSurvey             => 'ft (US survey)',
            self::HundredFootLinear        => 'hundred ft',
            self::LinearFoot               => 'lft',
            self::Link                     => 'lnk',
            self::LinearMetre              => 'lm',
            self::MileStatuteMile          => 'mile',
            self::Picometre                => 'pm',
            self::Parsec                   => 'pc',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Metre                    => 'metre',
            self::Angstrom                 => 'angstrom',
            self::Femtometre               => 'femtometre',
            self::Nanometre                => 'nanometre',
            self::Micrometre               => 'micrometre',
            self::AstronomicalUnit         => 'astronomical unit',
            self::Decimetre                => 'decimetre',
            self::Centimetre               => 'centimetre',
            self::Millimetre               => 'millimetre',
            self::Inch                     => 'inch',
            self::Foot                     => 'foot',
            self::Yard                     => 'yard',
            self::NauticalMile             => 'nautical mile',
            self::Decametre                => 'decametre',
            self::Hectometre               => 'hectometre',
            self::Kilometre                => 'kilometre',
            self::LightYear                => 'light year',
            self::Fathom                   => 'fathom',
            self::Furlong                  => 'furlong',
            self::ChainBasedOnUSSurveyFoot => 'chain (based on US survey foot)',
            self::GuntersChain             => 'Gunter\'s chain',
            self::FootUSSurvey             => 'foot (US survey)',
            self::HundredFootLinear        => 'hundred foot (linear)',
            self::LinearFoot               => 'linear foot',
            self::Link                     => 'link',
            self::LinearMetre              => 'linear metre',
            self::MileStatuteMile          => 'mile (statute mile)',
            self::Picometre                => 'picometre',
            self::Parsec                   => 'parsec',
        };
    }

    /**
     * @return list<string>
     */
    public function aliases(): array
    {
        $base = [$this->value, $this->symbol(), $this->label()];

        return match ($this) {
            self::Micrometre => [...$base, 'mu'],
            self::Kilometre  => [...$base, 'KTM'], // @deprecated Rec 20 code KTM
            default          => $base,
        };
    }

    public function multiplier(): string
    {
        return match ($this) {
            self::Metre                    => '1',
            self::Angstrom                 => '0.0000000001',
            self::Femtometre               => '0.000000000000001',
            self::Nanometre                => '0.000000001',
            self::Micrometre               => '0.000001',
            self::AstronomicalUnit         => '149597870000',
            self::Decimetre                => '0.1',
            self::Centimetre               => '0.01',
            self::Millimetre               => '0.001',
            self::Inch                     => '0.0254',
            self::Foot                     => '0.3048',
            self::Yard                     => '0.9144',
            self::NauticalMile             => '1852',
            self::Decametre                => '10',
            self::Hectometre               => '100',
            self::Kilometre                => '1000',
            self::LightYear                => '9460730000000000',
            self::Fathom                   => '1.8288',
            self::Furlong                  => '201.168',
            self::ChainBasedOnUSSurveyFoot => '20.11684',
            self::GuntersChain             => '20.1168',
            self::FootUSSurvey             => '0.3048006',
            self::HundredFootLinear        => '30.48',
            self::LinearFoot               => '0.3048',
            self::Link                     => '0.201168',
            self::LinearMetre              => '1',
            self::MileStatuteMile          => '1609.344',
            self::Picometre                => '0.000000000001',
            self::Parsec                   => '30856775814913700',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Length;
    }
}
