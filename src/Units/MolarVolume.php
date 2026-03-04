<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum MolarVolume: string implements Unit
{
    case CubicMetrePerMole      = 'A40';
    case CubicDecimetrePerMole  = 'A37';
    case CubicCentimetrePerMole = 'A36';
    case LitrePerMole           = 'B58';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::CubicMetrePerMole      => 'm³/mol',
            self::CubicDecimetrePerMole  => 'dm³/mol',
            self::CubicCentimetrePerMole => 'cm³/mol',
            self::LitrePerMole           => 'l/mol',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::CubicMetrePerMole      => 'cubic metre per mole',
            self::CubicDecimetrePerMole  => 'cubic decimetre per mole',
            self::CubicCentimetrePerMole => 'cubic centimetre per mole',
            self::LitrePerMole           => 'litre per mole',
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
            self::CubicMetrePerMole      => '1',
            self::CubicDecimetrePerMole  => '0.001',
            self::CubicCentimetrePerMole => '0.000001',
            self::LitrePerMole           => '0.001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::MolarVolume;
    }
}
