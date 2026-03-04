<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum AmountOfSubstance: string implements Unit
{
    case Mole      = 'C34';
    case Kilomole  = 'B45';
    case Millimole = 'C18';
    case Micromole = 'FH';

    public function symbol(): string
    {
        return match ($this) {
            self::Mole      => 'mol',
            self::Kilomole  => 'kmol',
            self::Millimole => 'mmol',
            self::Micromole => 'µmol',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Mole      => 'mole',
            self::Kilomole  => 'kilomole',
            self::Millimole => 'millimole',
            self::Micromole => 'micromole',
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
            self::Mole      => '1',
            self::Kilomole  => '1000',
            self::Millimole => '0.001',
            self::Micromole => '0.000001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::AmountOfSubstance;
    }
}
