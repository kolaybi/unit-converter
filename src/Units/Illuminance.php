<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Illuminance: string implements Unit
{
    case LumenPerSquareMetre = 'B60';
    case Lux                 = 'LUX';
    case Kilolux             = 'KLX';
    case LumenPerSquareFoot  = 'P25';
    case Phot                = 'P26';
    case Footcandle          = 'P27';

    public function symbol(): string
    {
        return match ($this) {
            self::LumenPerSquareMetre => 'lm/m²',
            self::Lux                 => 'lx',
            self::Kilolux             => 'klx',
            self::LumenPerSquareFoot  => 'lm/ft²',
            self::Phot                => 'ph',
            self::Footcandle          => 'ftc',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::LumenPerSquareMetre => 'lumen per square metre',
            self::Lux                 => 'lux',
            self::Kilolux             => 'kilolux',
            self::LumenPerSquareFoot  => 'lumen per square foot ',
            self::Phot                => 'phot',
            self::Footcandle          => 'footcandle',
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
            self::LumenPerSquareMetre => '1',
            self::Lux                 => '1',
            self::Kilolux             => '1000',
            self::LumenPerSquareFoot  => '10.76391',
            self::Phot                => '10000',
            self::Footcandle          => '10.76391',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Illuminance;
    }
}
