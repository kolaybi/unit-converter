<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Voltage: string implements Unit
{
    case Volt      = 'VLT';
    case Picovolt  = 'N99';
    case Millivolt = '2Z';
    case Megavolt  = 'B78';
    case Microvolt = 'D82';
    case Kilovolt  = 'KVT';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Volt      => 'V',
            self::Picovolt  => 'pV',
            self::Millivolt => 'mV',
            self::Megavolt  => 'MV',
            self::Microvolt => 'µV',
            self::Kilovolt  => 'kV',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Volt      => 'volt',
            self::Picovolt  => 'picovolt',
            self::Millivolt => 'millivolt',
            self::Megavolt  => 'megavolt',
            self::Microvolt => 'microvolt',
            self::Kilovolt  => 'kilovolt',
        };
    }

    /**
     * @return list<string>
     */
    public function aliases(): array
    {
        $aliases = [$this->value, $this->symbol(), $this->label()];

        if (self::Volt === $this) {
            $aliases[] = '2G';
            $aliases[] = '2H';
        }

        return $aliases;
    }

    public function multiplier(): string
    {
        return match ($this) {
            self::Volt      => '1',
            self::Picovolt  => '0.000000000001',
            self::Millivolt => '0.001',
            self::Megavolt  => '1000000',
            self::Microvolt => '0.000001',
            self::Kilovolt  => '1000',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Voltage;
    }
}
