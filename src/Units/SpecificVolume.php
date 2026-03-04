<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum SpecificVolume: string implements Unit
{
    case CubicMetrePerKilogram     = 'A39';
    case DecilitrePerGram          = '22';
    case LitrePerKilogram          = 'H83';
    case MillilitrePerKilogram     = 'KX';
    case CubicDecimetrePerKilogram = 'N28';
    case CubicFootPerPound         = 'N29';
    case CubicInchPerPound         = 'N30';

    public function symbol(): string
    {
        return match ($this) {
            self::CubicMetrePerKilogram     => 'm³/kg',
            self::DecilitrePerGram          => 'dl/g',
            self::LitrePerKilogram          => 'l/kg',
            self::MillilitrePerKilogram     => 'ml/kg',
            self::CubicDecimetrePerKilogram => 'dm³/kg',
            self::CubicFootPerPound         => 'ft³/lb',
            self::CubicInchPerPound         => 'in³/lb',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::CubicMetrePerKilogram     => 'cubic metre per kilogram',
            self::DecilitrePerGram          => 'decilitre per gram',
            self::LitrePerKilogram          => 'litre per kilogram',
            self::MillilitrePerKilogram     => 'millilitre per kilogram',
            self::CubicDecimetrePerKilogram => 'cubic decimetre per kilogram',
            self::CubicFootPerPound         => 'cubic foot per pound',
            self::CubicInchPerPound         => 'cubic inch per pound',
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
            self::CubicMetrePerKilogram     => '1',
            self::DecilitrePerGram          => '0.1',
            self::LitrePerKilogram          => '0.001',
            self::MillilitrePerKilogram     => '0.000001',
            self::CubicDecimetrePerKilogram => '0.001',
            self::CubicFootPerPound         => '0.06242796',
            self::CubicInchPerPound         => '0.00003612728',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::SpecificVolume;
    }
}
