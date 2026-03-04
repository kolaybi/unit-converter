<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum MolarConcentration: string implements Unit
{
    case MolePerCubicMetre     = 'C36';
    case MillimolePerLitre     = 'M33';
    case MolePerLitre          = 'C38';
    case MolePerCubicDecimetre = 'C35';
    case KilomolePerCubicMetre = 'B46';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::MolePerCubicMetre     => 'mol/m³',
            self::MillimolePerLitre     => 'mmol/l',
            self::MolePerLitre          => 'mol/l',
            self::MolePerCubicDecimetre => 'mol/dm³',
            self::KilomolePerCubicMetre => 'kmol/m³',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::MolePerCubicMetre     => 'mole per cubic metre',
            self::MillimolePerLitre     => 'millimole per litre',
            self::MolePerLitre          => 'mole per litre',
            self::MolePerCubicDecimetre => 'mole per cubic decimetre',
            self::KilomolePerCubicMetre => 'kilomole per cubic metre',
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
            self::MolePerCubicMetre     => '1',
            self::MillimolePerLitre     => '1',
            self::MolePerLitre          => '1000',
            self::MolePerCubicDecimetre => '1000',
            self::KilomolePerCubicMetre => '1000',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::MolarConcentration;
    }
}
