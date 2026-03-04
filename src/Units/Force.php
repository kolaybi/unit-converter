<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Force: string implements Unit
{
    case Newton                        = 'NEW';
    case Kilonewton                    = 'B47';
    case Meganewton                    = 'B73';
    case Micronewton                   = 'B92';
    case Millinewton                   = 'C20';
    case Dyne                          = 'DU';
    case PoundForce                    = 'C78';
    case KilogramForce                 = 'B37';
    case Kilopond                      = 'B51';
    case OunceAvoirdupoisForce         = 'L40';
    case TonForceUSShort               = 'L94';
    case KilopoundForce                = 'M75';
    case Poundal                       = 'M76';
    case KilogramMetrePerSecondSquared = 'M77';
    case Pond                          = 'M78';

    public function symbol(): string
    {
        return match ($this) {
            self::Newton                        => 'N',
            self::Kilonewton                    => 'kN',
            self::Meganewton                    => 'MN',
            self::Micronewton                   => 'µN',
            self::Millinewton                   => 'mN',
            self::Dyne                          => 'dyn',
            self::PoundForce                    => 'lbf',
            self::KilogramForce                 => 'kgf',
            self::Kilopond                      => 'kp',
            self::OunceAvoirdupoisForce         => 'ozf',
            self::TonForceUSShort               => 'ton.sh-force',
            self::KilopoundForce                => 'kip',
            self::Poundal                       => 'pdl',
            self::KilogramMetrePerSecondSquared => 'kg·m/s²',
            self::Pond                          => 'p',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Newton                        => 'newton',
            self::Kilonewton                    => 'kilonewton',
            self::Meganewton                    => 'meganewton',
            self::Micronewton                   => 'micronewton',
            self::Millinewton                   => 'millinewton',
            self::Dyne                          => 'dyne',
            self::PoundForce                    => 'pound-force',
            self::KilogramForce                 => 'kilogram-force',
            self::Kilopond                      => 'kilopond',
            self::OunceAvoirdupoisForce         => 'ounce (avoirdupois)-force',
            self::TonForceUSShort               => 'ton-force (US short)',
            self::KilopoundForce                => 'kilopound-force',
            self::Poundal                       => 'poundal',
            self::KilogramMetrePerSecondSquared => 'kilogram metre per second squared',
            self::Pond                          => 'pond',
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
            self::Newton                        => '1',
            self::Kilonewton                    => '1000',
            self::Meganewton                    => '1000000',
            self::Micronewton                   => '0.000001',
            self::Millinewton                   => '0.001',
            self::Dyne                          => '0.00001',
            self::PoundForce                    => '4.448222',
            self::KilogramForce                 => '9.80665',
            self::Kilopond                      => '9.80665',
            self::OunceAvoirdupoisForce         => '0.2780139',
            self::TonForceUSShort               => '8896.443',
            self::KilopoundForce                => '4448.222',
            self::Poundal                       => '0.138255',
            self::KilogramMetrePerSecondSquared => '1',
            self::Pond                          => '0.00980665',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Force;
    }
}
