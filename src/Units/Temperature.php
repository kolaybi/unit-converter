<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Temperature: string implements Unit
{
    case Kelvin = 'KEL';
    case Fahrenheit = 'FAH';
    case Celsius = 'CEL';
    case Rankine = 'A48';

    public function symbol(): string
    {
        return match ($this) {
            self::Kelvin     => 'K',
            self::Fahrenheit => '°F',
            self::Celsius    => '°C',
            self::Rankine    => '°R',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Kelvin     => 'kelvin',
            self::Fahrenheit => 'degrees Fahrenheit',
            self::Celsius    => 'degrees Celsius',
            self::Rankine    => 'degrees Rankine',
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
            self::Kelvin     => '1',
            self::Fahrenheit => '0.5555555555555556',
            self::Celsius    => '1',
            self::Rankine    => '0.5555555555555556',
        };
    }

    public function offset(): string
    {
        return match ($this) {
            self::Kelvin     => '0',
            self::Fahrenheit => '255.3722222222222',
            self::Celsius    => '273.15',
            self::Rankine    => '0',
        };
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Temperature;
    }
}
