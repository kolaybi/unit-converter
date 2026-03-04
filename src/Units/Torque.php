<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Torque: string implements Unit
{
    case NewtonMetre               = 'NU';
    case NewtonCentimetre          = 'F88';
    case MeganewtonMetre           = 'B74';
    case KilonewtonMetre           = 'B48';
    case MillinewtonMetre          = 'D83';
    case MicronewtonMetre          = 'B93';
    case DecinewtonMetre           = 'DN';
    case CentinewtonMetre          = 'J72';
    case KilogramForceMetre        = 'B38';
    case PoundForceInch            = 'F21';
    case DyneCentimetre            = 'J94';
    case OunceAvoirdupoisForceInch = 'L41';
    case PoundForceFoot            = 'M92';
    case PoundalFoot               = 'M95';
    case PoundalInch               = 'M96';
    case DyneMetre                 = 'M97';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::NewtonMetre               => 'N·m',
            self::NewtonCentimetre          => 'N·cm',
            self::MeganewtonMetre           => 'MN·m',
            self::KilonewtonMetre           => 'kN·m',
            self::MillinewtonMetre          => 'mN·m',
            self::MicronewtonMetre          => 'µN·m',
            self::DecinewtonMetre           => 'dN·m',
            self::CentinewtonMetre          => 'cN·m',
            self::KilogramForceMetre        => 'kgf·m',
            self::PoundForceInch            => 'lbf·in',
            self::DyneCentimetre            => 'dyn·cm',
            self::OunceAvoirdupoisForceInch => 'ozf·in',
            self::PoundForceFoot            => 'lbf·ft',
            self::PoundalFoot               => 'pdl·ft',
            self::PoundalInch               => 'pdl·in',
            self::DyneMetre                 => 'dyn·m',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::NewtonMetre               => 'newton metre',
            self::NewtonCentimetre          => 'newton centimetre',
            self::MeganewtonMetre           => 'meganewton metre',
            self::KilonewtonMetre           => 'kilonewton metre',
            self::MillinewtonMetre          => 'millinewton metre',
            self::MicronewtonMetre          => 'micronewton metre',
            self::DecinewtonMetre           => 'decinewton metre',
            self::CentinewtonMetre          => 'centinewton metre',
            self::KilogramForceMetre        => 'kilogram-force metre',
            self::PoundForceInch            => 'pound-force inch',
            self::DyneCentimetre            => 'dyne centimetre',
            self::OunceAvoirdupoisForceInch => 'ounce (avoirdupois)-force inch',
            self::PoundForceFoot            => 'pound-force foot',
            self::PoundalFoot               => 'poundal foot',
            self::PoundalInch               => 'poundal inch',
            self::DyneMetre                 => 'dyne metre',
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
            self::NewtonMetre               => '1',
            self::NewtonCentimetre          => '0.01',
            self::MeganewtonMetre           => '1000000',
            self::KilonewtonMetre           => '1000',
            self::MillinewtonMetre          => '0.001',
            self::MicronewtonMetre          => '0.000001',
            self::DecinewtonMetre           => '0.1',
            self::CentinewtonMetre          => '0.01',
            self::KilogramForceMetre        => '9.80665',
            self::PoundForceInch            => '0.112985',
            self::DyneCentimetre            => '0.0000001',
            self::OunceAvoirdupoisForceInch => '0.007061552',
            self::PoundForceFoot            => '1.355818',
            self::PoundalFoot               => '0.04214011',
            self::PoundalInch               => '0.003511677',
            self::DyneMetre                 => '0.00001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Torque;
    }
}
