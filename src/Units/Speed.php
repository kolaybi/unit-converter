<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Speed: string implements Unit
{
    case KilometresPerHour    = 'KMH';
    case MetresPerSecond      = 'MTS';
    case MilesPerHour         = 'HM';
    case MilesPerMinute       = 'M57';
    case MilesPerSecond       = 'M58';
    case Knot                 = 'KNT';
    case KilometresPerSecond  = 'M62';
    case CentimetresPerHour   = 'H49';
    case CentimetresPerSecond = '2M';
    case FootPerHour          = 'K14';
    case FootPerMinute        = 'FR';
    case FootPerSecond        = 'FS';
    case InchPerMinute        = 'M63';
    case InchPerSecond        = 'IU';
    case InchPerYear          = 'M61';
    case MetrePerMinute       = '2X';
    case MillimetrePerSecond  = 'C16';
    case MillimetrePerHour    = 'H67';
    case MillimetrePerMinute  = 'H81';
    case MetrePerHour         = 'M60';
    case YardPerSecond        = 'M64';
    case YardPerMinute        = 'M65';
    case YardPerHour          = 'M66';

    public function symbol(): string
    {
        return match ($this) {
            self::KilometresPerHour    => 'km/h',
            self::MetresPerSecond      => 'm/s',
            self::MilesPerHour         => 'mile/h',
            self::MilesPerMinute       => 'mi/min',
            self::MilesPerSecond       => 'mi/s',
            self::Knot                 => 'kn',
            self::KilometresPerSecond  => 'km/s',
            self::CentimetresPerHour   => 'cm/h',
            self::CentimetresPerSecond => 'cm/s',
            self::FootPerHour          => 'ft/h',
            self::FootPerMinute        => 'ft/min',
            self::FootPerSecond        => 'ft/s',
            self::InchPerMinute        => 'in/min',
            self::InchPerSecond        => 'in/s',
            self::InchPerYear          => 'in/y',
            self::MetrePerMinute       => 'm/min',
            self::MillimetrePerSecond  => 'mm/s',
            self::MillimetrePerHour    => 'mm/h',
            self::MillimetrePerMinute  => 'mm/min',
            self::MetrePerHour         => 'm/h',
            self::YardPerSecond        => 'yd/s',
            self::YardPerMinute        => 'yd/min',
            self::YardPerHour          => 'yd/h',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::KilometresPerHour    => 'kilometres per hour',
            self::MetresPerSecond      => 'metres per second',
            self::MilesPerHour         => 'miles per hour',
            self::MilesPerMinute       => 'miles per minute',
            self::MilesPerSecond       => 'miles per second',
            self::Knot                 => 'knot',
            self::KilometresPerSecond  => 'kilometres per second',
            self::CentimetresPerHour   => 'centimetres per hour',
            self::CentimetresPerSecond => 'centimetres per second',
            self::FootPerHour          => 'foot per hour',
            self::FootPerMinute        => 'foot per minute',
            self::FootPerSecond        => 'foot per second',
            self::InchPerMinute        => 'inch per minute',
            self::InchPerSecond        => 'inch per second',
            self::InchPerYear          => 'inch per year',
            self::MetrePerMinute       => 'metre per minute',
            self::MillimetrePerSecond  => 'millimetre per second',
            self::MillimetrePerHour    => 'millimetre per hour',
            self::MillimetrePerMinute  => 'millimetre per minute',
            self::MetrePerHour         => 'metre per hour',
            self::YardPerSecond        => 'yard per second',
            self::YardPerMinute        => 'yard per minute',
            self::YardPerHour          => 'yard per hour',
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
            self::KilometresPerHour    => '0.277777778',
            self::MetresPerSecond      => '1',
            self::MilesPerHour         => '0.44704',
            self::MilesPerMinute       => '26.8224',
            self::MilesPerSecond       => '1609.344',
            self::Knot                 => '0.514444',
            self::KilometresPerSecond  => '1000',
            self::CentimetresPerHour   => '0.000000277777778',
            self::CentimetresPerSecond => '0.01',
            self::FootPerHour          => '0.00008466667',
            self::FootPerMinute        => '0.00508',
            self::FootPerSecond        => '0.3048',
            self::InchPerMinute        => '0.0004233333',
            self::InchPerSecond        => '0.0254',
            self::InchPerYear          => '0.0000000008048774',
            self::MetrePerMinute       => '0.016666666666666666',
            self::MillimetrePerSecond  => '0.001',
            self::MillimetrePerHour    => '0.0000002777777777777',
            self::MillimetrePerMinute  => '0.000016666666666666',
            self::MetrePerHour         => '0.0002777777777777',
            self::YardPerSecond        => '0.9144',
            self::YardPerMinute        => '0.01524',
            self::YardPerHour          => '0.000254',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Speed;
    }
}
