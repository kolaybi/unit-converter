<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum EffectiveDoseRate: string implements Unit
{
    case SievertPerSecond      = 'P65';
    case MillisievertPerSecond = 'P66';
    case MicrosievertPerSecond = 'P67';
    case NanosievertPerSecond  = 'P68';
    case RemPerSecond          = 'P69';
    case SievertPerHour        = 'P70';
    case MillisievertPerHour   = 'P71';
    case MicrosievertPerHour   = 'P72';
    case NanosievertPerHour    = 'P73';
    case SievertPerMinute      = 'P74';
    case MillisievertPerMinute = 'P75';
    case MicrosievertPerMinute = 'P76';
    case NanosievertPerMinute  = 'P77';

    public function symbol(): string
    {
        return match ($this) {
            self::SievertPerSecond      => 'Sv/s',
            self::MillisievertPerSecond => 'mSv/s',
            self::MicrosievertPerSecond => 'µSv/s',
            self::NanosievertPerSecond  => 'nSv/s',
            self::RemPerSecond          => 'rem/s',
            self::SievertPerHour        => 'Sv/h',
            self::MillisievertPerHour   => 'mSv/h',
            self::MicrosievertPerHour   => 'µSv/h',
            self::NanosievertPerHour    => 'nSv/h',
            self::SievertPerMinute      => 'Sv/min',
            self::MillisievertPerMinute => 'mSv/min',
            self::MicrosievertPerMinute => 'µSv/min',
            self::NanosievertPerMinute  => 'nSv/min',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::SievertPerSecond      => 'sievert per second',
            self::MillisievertPerSecond => 'millisievert per second',
            self::MicrosievertPerSecond => 'microsievert per second',
            self::NanosievertPerSecond  => 'nanosievert per second',
            self::RemPerSecond          => 'rem per second',
            self::SievertPerHour        => 'sievert per hour',
            self::MillisievertPerHour   => 'millisievert per hour',
            self::MicrosievertPerHour   => 'microsievert per hour',
            self::NanosievertPerHour    => 'nanosievert per hour',
            self::SievertPerMinute      => 'sievert per minute',
            self::MillisievertPerMinute => 'millisievert per minute',
            self::MicrosievertPerMinute => 'microsievert per minute',
            self::NanosievertPerMinute  => 'nanosievert per minute',
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
            self::SievertPerSecond      => '1',
            self::MillisievertPerSecond => '0.001',
            self::MicrosievertPerSecond => '0.000001',
            self::NanosievertPerSecond  => '0.000000001',
            self::RemPerSecond          => '0.01',
            self::SievertPerHour        => '0.000277778',
            self::MillisievertPerHour   => '0.0000000277777778',
            self::MicrosievertPerHour   => '0.0000000000277777778',
            self::NanosievertPerHour    => '0.0000000000000277777778',
            self::SievertPerMinute      => '0.016666',
            self::MillisievertPerMinute => '0.00001666666667',
            self::MicrosievertPerMinute => '0.00000001666666667',
            self::NanosievertPerMinute  => '0.00000000001666666667',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::EffectiveDoseRate;
    }
}
