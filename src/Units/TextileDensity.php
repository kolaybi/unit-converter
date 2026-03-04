<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum TextileDensity: string implements Unit
{
    case Tex     = 'D34';
    case Decitex = 'A47';
    case Denier  = 'A49';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Tex     => 'tex',
            self::Decitex => 'dtex',
            self::Denier  => 'den',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Tex     => 'tex',
            self::Decitex => 'decitex',
            self::Denier  => 'denier',
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
            self::Tex     => '0.000001',
            self::Decitex => '0.0000001',
            self::Denier  => '0.000000111111111',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::TextileDensity;
    }
}
