<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Time: string implements Unit
{
    case Second       = 'SEC';
    case Minute       = 'MIN';
    case Hour         = 'HUR';
    case Day          = 'DAY';
    case Kilosecond   = 'B52';
    case Millisecond  = 'C26';
    case Picosecond   = 'H70';
    case Microsecond  = 'B98';
    case Nanosecond   = 'C47';
    case Week         = 'WEE';
    case Month        = 'MON';
    case Year         = 'ANN';
    case TropicalYear = 'D42';
    case CommonYear   = 'L95';
    case SiderealYear = 'L96';
    case Shake        = 'M56';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Second       => 's',
            self::Minute       => 'min',
            self::Hour         => 'h',
            self::Day          => 'd',
            self::Kilosecond   => 'ks',
            self::Millisecond  => 'ms',
            self::Picosecond   => 'ps',
            self::Microsecond  => 'µs',
            self::Nanosecond   => 'ns',
            self::Week         => 'wk',
            self::Month        => 'mo',
            self::Year         => 'y',
            self::TropicalYear => 'y (tropical)',
            self::CommonYear   => 'y (365 days)',
            self::SiderealYear => 'y (sidereal)',
            self::Shake        => 'shake',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Second       => 'second',
            self::Minute       => 'minute',
            self::Hour         => 'hour',
            self::Day          => 'day',
            self::Kilosecond   => 'kilosecond',
            self::Millisecond  => 'millisecond',
            self::Picosecond   => 'picosecond',
            self::Microsecond  => 'microsecond',
            self::Nanosecond   => 'nanosecond',
            self::Week         => 'week',
            self::Month        => 'month',
            self::Year         => 'year',
            self::TropicalYear => 'tropical year',
            self::CommonYear   => 'common year',
            self::SiderealYear => 'sidereal year',
            self::Shake        => 'shake',
        };
    }

    /**
     * @return list<string>
     */
    public function aliases(): array
    {
        $base = [$this->value, $this->symbol(), $this->label()];

        return match ($this) {
            self::Year => [...$base, 'AYR'], // @deprecated Rec 20 code AYR
            default    => $base,
        };
    }

    public function multiplier(): string
    {
        return match ($this) {
            self::Second       => '1',
            self::Minute       => '60',
            self::Hour         => '3600',
            self::Day          => '86400',
            self::Kilosecond   => '1000',
            self::Millisecond  => '0.001',
            self::Picosecond   => '0.000000000001',
            self::Microsecond  => '0.000001',
            self::Nanosecond   => '0.000000001',
            self::Week         => '604800',
            self::Month        => '2629800',
            self::Year         => '31557600',
            self::TropicalYear => '31556925',
            self::CommonYear   => '31536000',
            self::SiderealYear => '31558150',
            self::Shake        => '0.00000001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Time;
    }
}
