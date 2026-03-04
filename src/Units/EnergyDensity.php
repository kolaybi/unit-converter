<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum EnergyDensity: string implements Unit
{
    case ErgPerCubicCentimetre                            = 'A60';
    case JoulePerCubicMetre                               = 'B8';
    case KilowattHourPerCubicMetre                        = 'E46';
    case MegajoulePerCubicMetre                           = 'JM';
    case BritishThermalUnitInternationalTablePerCubicFoot = 'N58';
    case BritishThermalUnitThermochemicalPerCubicFoot     = 'N59';
    case CaloriePerCubicCentimetre                        = '92';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::ErgPerCubicCentimetre                            => 'erg/cm³',
            self::JoulePerCubicMetre                               => 'J/m³',
            self::KilowattHourPerCubicMetre                        => 'kW·h/m³',
            self::MegajoulePerCubicMetre                           => 'MJ/m³',
            self::BritishThermalUnitInternationalTablePerCubicFoot => 'BtuIT/ft³',
            self::BritishThermalUnitThermochemicalPerCubicFoot     => 'Btuth/ft³',
            self::CaloriePerCubicCentimetre                        => 'cal/cm³',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::ErgPerCubicCentimetre                            => 'erg per cubic centimetre',
            self::JoulePerCubicMetre                               => 'joule per cubic metre',
            self::KilowattHourPerCubicMetre                        => 'kilowatt hour per cubic metre',
            self::MegajoulePerCubicMetre                           => 'megajoule per cubic metre',
            self::BritishThermalUnitInternationalTablePerCubicFoot => 'British thermal unit (international table) per cubic foot ',
            self::BritishThermalUnitThermochemicalPerCubicFoot     => 'British thermal unit (thermochemical) per cubic foot',
            self::CaloriePerCubicCentimetre                        => 'calorie per cubic centimetre',
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
            self::ErgPerCubicCentimetre                            => '0.1',
            self::JoulePerCubicMetre                               => '1',
            self::KilowattHourPerCubicMetre                        => '3600000',
            self::MegajoulePerCubicMetre                           => '1000000',
            self::BritishThermalUnitInternationalTablePerCubicFoot => '37258.95',
            self::BritishThermalUnitThermochemicalPerCubicFoot     => '37234.03',
            self::CaloriePerCubicCentimetre                        => '4186800',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::EnergyDensity;
    }
}
