<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum MolarMass: string implements Unit
{
    case KilogramPerMole = 'D74';
    case GramPerMole     = 'A94';

    public function symbol(): string
    {
        return match ($this) {
            self::KilogramPerMole => 'kg/mol',
            self::GramPerMole     => 'g/mol',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::KilogramPerMole => 'kilogram per mole',
            self::GramPerMole     => 'gram per mole',
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
            self::KilogramPerMole => '1',
            self::GramPerMole     => '0.001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::MolarMass;
    }
}
