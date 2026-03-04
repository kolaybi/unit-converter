<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum MolarThermodynamicEnergy: string implements Unit
{
    case JoulePerMole     = 'B15';
    case KilojoulePerMole = 'B44';

    public function symbol(): string
    {
        return match ($this) {
            self::JoulePerMole     => 'J/mol',
            self::KilojoulePerMole => 'kJ/mol',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::JoulePerMole     => 'joule per mole',
            self::KilojoulePerMole => 'kilojoule per mole',
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
            self::JoulePerMole     => '1',
            self::KilojoulePerMole => '1000',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::MolarThermodynamicEnergy;
    }
}
