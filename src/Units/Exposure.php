<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Exposure: string implements Unit
{
    case LuxHour   = 'B63';
    case LuxSecond = 'B64';

    public function symbol(): string
    {
        return match ($this) {
            self::LuxHour   => 'lx·h',
            self::LuxSecond => 'lx·s',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::LuxHour   => 'lux hour',
            self::LuxSecond => 'lux second',
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
            self::LuxHour   => '3600',
            self::LuxSecond => '1',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Exposure;
    }
}
