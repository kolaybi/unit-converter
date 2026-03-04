<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum MagneticVectorPotential: string implements Unit
{
    case WeberPerMetre      = 'D59';
    case KiloweberPerMetre  = 'B56';
    case WeberPerMillimetre = 'D60';

    public function symbol(): string
    {
        return match ($this) {
            self::WeberPerMetre      => 'Wb/m',
            self::KiloweberPerMetre  => 'kWb/m',
            self::WeberPerMillimetre => 'Wb/mm',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::WeberPerMetre      => 'weber per metre',
            self::KiloweberPerMetre  => 'kiloweber per metre',
            self::WeberPerMillimetre => 'weber per millimetre',
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
            self::WeberPerMetre      => '1',
            self::KiloweberPerMetre  => '1000',
            self::WeberPerMillimetre => '1000',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::MagneticVectorPotential;
    }
}
