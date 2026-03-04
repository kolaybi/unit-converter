<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum LuminousIntensity: string implements Unit
{
    case Candela      = 'CDL';
    case Kilocandela  = 'P33';
    case Millicandela = 'P34';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Candela      => 'cd',
            self::Kilocandela  => 'kcd',
            self::Millicandela => 'mcd',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Candela      => 'candela',
            self::Kilocandela  => 'kilocandela',
            self::Millicandela => 'millicandela',
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
            self::Candela      => '1',
            self::Kilocandela  => '1000',
            self::Millicandela => '0.001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::LuminousIntensity;
    }
}
