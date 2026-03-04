<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum AbsorbedDose: string implements Unit
{
    case Gray       = 'A95';
    case Milligray  = 'C13';
    case Rad        = 'C80';
    case ErgPerGram = 'A61';

    public function symbol(): string
    {
        return match ($this) {
            self::Gray       => 'Gy',
            self::Milligray  => 'mGy',
            self::Rad        => 'rad',
            self::ErgPerGram => 'J/kg',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Gray       => 'gray',
            self::Milligray  => 'milligray',
            self::Rad        => 'rad',
            self::ErgPerGram => 'erg per gram',
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
            self::Gray       => '1',
            self::Milligray  => '0.001',
            self::Rad        => '0.01',
            self::ErgPerGram => '0.0001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::AbsorbedDose;
    }
}
