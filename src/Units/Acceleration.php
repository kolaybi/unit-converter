<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Acceleration: string implements Unit
{
    case MetrePerSecondSquared           = 'MSK';
    case Gal                             = 'A76';
    case Milligal                        = 'C11';
    case KilometrePerSecondSquared       = 'M38';
    case CentimetrePerSecondSquared      = 'M39';
    case MillimetrePerSecondSquared      = 'M41';
    case FootPerSecondSquared            = 'A73';
    case InchPerSecondSquared            = 'IV';
    case StandardAccelerationOfFreeFall  = 'K40';
    case YardPerSecondSquared            = 'M40';
    case MileStatuteMilePerSecondSquared = 'M42';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::MetrePerSecondSquared           => 'm/s²',
            self::Gal                             => 'Gal',
            self::Milligal                        => 'mGal',
            self::KilometrePerSecondSquared       => 'km/s²',
            self::CentimetrePerSecondSquared      => 'cm/s²',
            self::MillimetrePerSecondSquared      => 'mm/s²',
            self::FootPerSecondSquared            => 'ft/s²',
            self::InchPerSecondSquared            => 'in/s²',
            self::StandardAccelerationOfFreeFall  => 'gn',
            self::YardPerSecondSquared            => 'yd/s²',
            self::MileStatuteMilePerSecondSquared => 'mi/s²',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::MetrePerSecondSquared           => 'metre per second squared',
            self::Gal                             => 'gal',
            self::Milligal                        => 'milligal',
            self::KilometrePerSecondSquared       => 'kilometre per second squared',
            self::CentimetrePerSecondSquared      => 'centimetre per second squared',
            self::MillimetrePerSecondSquared      => 'millimetre per second squared',
            self::FootPerSecondSquared            => 'foot per second squared',
            self::InchPerSecondSquared            => 'inch per second squared',
            self::StandardAccelerationOfFreeFall  => 'standard acceleration of free fall',
            self::YardPerSecondSquared            => 'yard per second squared',
            self::MileStatuteMilePerSecondSquared => 'mile (statute mile) per second squared',
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
            self::MetrePerSecondSquared           => '1',
            self::Gal                             => '0.01',
            self::Milligal                        => '0.00001',
            self::KilometrePerSecondSquared       => '1000',
            self::CentimetrePerSecondSquared      => '0.01',
            self::MillimetrePerSecondSquared      => '0.001',
            self::FootPerSecondSquared            => '0.3048',
            self::InchPerSecondSquared            => '0.0254',
            self::StandardAccelerationOfFreeFall  => '9.80665',
            self::YardPerSecondSquared            => '0.9144',
            self::MileStatuteMilePerSecondSquared => '1609.344',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Acceleration;
    }
}
