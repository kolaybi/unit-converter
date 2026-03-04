<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Resistance: string implements Unit
{
    case Ohm      = 'OHM';
    case Gigaohm  = 'A87';
    case Megaohm  = 'B75';
    case Teraohm  = 'H44';
    case Kiloohm  = 'B49';
    case Milliohm = 'E45';
    case Microohm = 'B94';
    case Nanoohm  = 'P22';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Ohm      => 'Ω',
            self::Gigaohm  => 'GΩ',
            self::Megaohm  => 'MΩ',
            self::Teraohm  => 'TΩ',
            self::Kiloohm  => 'kΩ',
            self::Milliohm => 'mΩ',
            self::Microohm => 'µΩ',
            self::Nanoohm  => 'nΩ',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Ohm      => 'ohm',
            self::Gigaohm  => 'gigaohm',
            self::Megaohm  => 'megaohm',
            self::Teraohm  => 'teraohm',
            self::Kiloohm  => 'kiloohm',
            self::Milliohm => 'milliohm',
            self::Microohm => 'microohm',
            self::Nanoohm  => 'nanoohm',
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
            self::Ohm      => '1',
            self::Gigaohm  => '1000000000',
            self::Megaohm  => '1000000',
            self::Teraohm  => '1000000000000',
            self::Kiloohm  => '1000',
            self::Milliohm => '0.001',
            self::Microohm => '0.000001',
            self::Nanoohm  => '0.000000001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Resistance;
    }
}
