<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum AngularImpulse: string implements Unit
{
    case NewtonMetreSecond             = 'C53';
    case KilogramMetreSquaredPerSecond = 'B33';

    /** @deprecated Use standard Rec 20 codes instead. */
    case KilogramSquareMetre = 'B32';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::NewtonMetreSecond             => 'N·m·s',
            self::KilogramMetreSquaredPerSecond => 'kg·m²/s',
            self::KilogramSquareMetre           => 'kg·m²',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::NewtonMetreSecond             => 'newton metre second',
            self::KilogramMetreSquaredPerSecond => 'kilogram metre squared per second',
            self::KilogramSquareMetre           => 'kilogram square metre',
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
            self::NewtonMetreSecond             => '1',
            self::KilogramMetreSquaredPerSecond => '1',
            self::KilogramSquareMetre           => '1',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::AngularImpulse;
    }
}
