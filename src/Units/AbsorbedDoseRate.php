<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum AbsorbedDoseRate: string implements Unit
{
    case MiligrayPerSecond  = 'P54';
    case MicrograyPerSecond = 'P55';
    case NanograyPerSecond  = 'P56';
    case GrayPerMinute      = 'P57';
    case MilligrayPerMinute = 'P58';
    case MicrograyPerMinute = 'P59';
    case NanograyPerMinute  = 'P60';
    case GrayPerHour        = 'P61';
    case MilligrayPerHour   = 'P62';
    case MicrograyPerHour   = 'P63';
    case NanograyPerHour    = 'P64';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::MiligrayPerSecond  => 'mGy/s',
            self::MicrograyPerSecond => 'µGy/s',
            self::NanograyPerSecond  => 'nGy/s',
            self::GrayPerMinute      => 'Gy/min',
            self::MilligrayPerMinute => 'mGy/min',
            self::MicrograyPerMinute => 'µGy/min',
            self::NanograyPerMinute  => 'nGy/min',
            self::GrayPerHour        => 'Gy/h',
            self::MilligrayPerHour   => 'mGy/h',
            self::MicrograyPerHour   => 'µGy/h',
            self::NanograyPerHour    => 'nGy/h',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::MiligrayPerSecond  => 'miligray per second',
            self::MicrograyPerSecond => 'microgray per second',
            self::NanograyPerSecond  => 'nanogray per second',
            self::GrayPerMinute      => 'gray per minute',
            self::MilligrayPerMinute => 'milligray per minute',
            self::MicrograyPerMinute => 'microgray per minute',
            self::NanograyPerMinute  => 'nanogray per minute',
            self::GrayPerHour        => 'gray per hour',
            self::MilligrayPerHour   => 'milligray per hour',
            self::MicrograyPerHour   => 'microgray per hour',
            self::NanograyPerHour    => 'nanogray per hour',
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
            self::MiligrayPerSecond  => '0.001',
            self::MicrograyPerSecond => '0.000001',
            self::NanograyPerSecond  => '0.000000001',
            self::GrayPerMinute      => '0.0166667',
            self::MilligrayPerMinute => '0.0000166667',
            self::MicrograyPerMinute => '0.0000000166667',
            self::NanograyPerMinute  => '0.0000000000166667',
            self::GrayPerHour        => '0.000277778',
            self::MilligrayPerHour   => '0.000000277778',
            self::MicrograyPerHour   => '0.000000000277778',
            self::NanograyPerHour    => '0.000000000000277778',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::AbsorbedDoseRate;
    }
}
