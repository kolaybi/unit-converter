<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum KinematicViscosity: string implements Unit
{
    case Centistokes                = '4C';
    case Stokes                     = '91';
    case MillimetreSquaredPerSecond = 'C17';
    case SquareFootPerHour          = 'M79';
    case SquareCentimetrePerSecond  = 'M81';
    case SquareFootPerSecond        = 'S3';
    case SquareMetrePerSecond       = 'S4';

    public function symbol(): string
    {
        return match ($this) {
            self::Centistokes                => 'cSt',
            self::Stokes                     => 'St',
            self::MillimetreSquaredPerSecond => 'mm²/s',
            self::SquareFootPerHour          => 'ft²/h',
            self::SquareCentimetrePerSecond  => 'cm²/s',
            self::SquareFootPerSecond        => 'ft²/s',
            self::SquareMetrePerSecond       => 'm²/s',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Centistokes                => 'centistokes',
            self::Stokes                     => 'stokes',
            self::MillimetreSquaredPerSecond => 'millimetre squared per second',
            self::SquareFootPerHour          => 'square foot per hour ',
            self::SquareCentimetrePerSecond  => 'square centimetre per second',
            self::SquareFootPerSecond        => 'square foot per second',
            self::SquareMetrePerSecond       => 'square metre per second',
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
            self::Centistokes                => '0.000001',
            self::Stokes                     => '0.0001',
            self::MillimetreSquaredPerSecond => '0.000001',
            self::SquareFootPerHour          => '0.0000258064',
            self::SquareCentimetrePerSecond  => '0.0001',
            self::SquareFootPerSecond        => '0.09290304',
            self::SquareMetrePerSecond       => '1',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::KinematicViscosity;
    }
}
