<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum MagneticFlux: string implements Unit
{
    case Weber      = 'WEB';
    case Milliweber = 'C33';
    case Kiloweber  = 'P11';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Weber      => 'Wb',
            self::Milliweber => 'mWb',
            self::Kiloweber  => 'kWb',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Weber      => 'weber',
            self::Milliweber => 'milliweber',
            self::Kiloweber  => 'kiloweber',
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
            self::Weber      => '1',
            self::Milliweber => '0.001',
            self::Kiloweber  => '1000',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::MagneticFlux;
    }
}
