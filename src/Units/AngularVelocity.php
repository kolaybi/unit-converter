<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum AngularVelocity: string implements Unit
{
    case RadiansPerSecond         = '2A';
    case RevolutionsPerMinute     = 'M46';
    case RevolutionsPerMinute_RPM = 'RPM';
    case RevolutionsPerSecond     = 'RPS';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::RadiansPerSecond         => 'rad/s',
            self::RevolutionsPerMinute     => 'r/min',
            self::RevolutionsPerMinute_RPM => 'r/min',
            self::RevolutionsPerSecond     => 'r/s',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::RadiansPerSecond         => 'radians per second',
            self::RevolutionsPerMinute     => 'revolutions per minute',
            self::RevolutionsPerMinute_RPM => 'revolutions per minute',
            self::RevolutionsPerSecond     => 'revolutions per second',
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
            self::RadiansPerSecond         => '1',
            self::RevolutionsPerMinute     => '0.104719755',
            self::RevolutionsPerMinute_RPM => '0.104719755',
            self::RevolutionsPerSecond     => '6.2831853',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::AngularVelocity;
    }
}
