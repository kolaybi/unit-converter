<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum DimensionlessConcentration: string implements Unit
{
    case Percent                      = 'P1';
    case PartPerMillion               = '59';
    case PartPerBillionUS             = '61';
    case PercentWeight                = '60';
    case PartPerHundredThousand       = 'E40';
    case PartPerThousandPerMille      = 'NX';
    case GramPerKilogram              = 'GK';
    case MilligramPerKilogram         = 'NA';
    case MicrogramPerKilogram         = 'J33';
    case NanogramPerKilogram          = 'L32';
    case KilogramPerKilogram          = 'M29';
    case LitrePerLitre                = 'K62';
    case MillilitrePerLitre           = 'L19';
    case MicrolitrePerLitre           = 'J36';
    case CubicMetrePerCubicMetre      = 'H60';
    case MillilitrePerCubicMetre      = 'H65';
    case CubicCentimetrePerCubicMetre = 'J87';
    case CubicMillimetrePerCubicMetre = 'L21';
    case CubicDecimetrePerCubicMetre  = 'J91';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Percent                      => '%',
            self::PartPerMillion               => 'ppm',
            self::PartPerBillionUS             => 'ppm',
            self::PercentWeight                => 'wt%',
            self::PartPerHundredThousand       => 'ppht',
            self::PartPerThousandPerMille      => '‰',
            self::GramPerKilogram              => 'g/kg',
            self::MilligramPerKilogram         => 'mg/kg',
            self::MicrogramPerKilogram         => 'µg/kg',
            self::NanogramPerKilogram          => 'ng/kg',
            self::KilogramPerKilogram          => 'kg/kg',
            self::LitrePerLitre                => 'l/l',
            self::MillilitrePerLitre           => 'ml/l',
            self::MicrolitrePerLitre           => 'µl/l',
            self::CubicMetrePerCubicMetre      => 'm³/m³',
            self::MillilitrePerCubicMetre      => 'ml/m³',
            self::CubicCentimetrePerCubicMetre => 'cm³/m³',
            self::CubicMillimetrePerCubicMetre => 'mm³/m³',
            self::CubicDecimetrePerCubicMetre  => 'dm³/m³',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Percent                      => 'percent',
            self::PartPerMillion               => 'part per million',
            self::PartPerBillionUS             => 'part per billion (US)',
            self::PercentWeight                => 'percent weight',
            self::PartPerHundredThousand       => 'part per hundred thousand',
            self::PartPerThousandPerMille      => 'part per thousand, per mille',
            self::GramPerKilogram              => 'gram per kilogram',
            self::MilligramPerKilogram         => 'milligram per kilogram',
            self::MicrogramPerKilogram         => 'microgram per kilogram',
            self::NanogramPerKilogram          => 'nanogram per kilogram',
            self::KilogramPerKilogram          => 'kilogram per kilogram',
            self::LitrePerLitre                => 'litre per litre',
            self::MillilitrePerLitre           => 'millilitre per litre',
            self::MicrolitrePerLitre           => 'microlitre per litre',
            self::CubicMetrePerCubicMetre      => 'cubic metre per cubic metre',
            self::MillilitrePerCubicMetre      => 'millilitre per cubic metre',
            self::CubicCentimetrePerCubicMetre => 'cubic centimetre per cubic metre',
            self::CubicMillimetrePerCubicMetre => 'cubic millimetre per cubic metre',
            self::CubicDecimetrePerCubicMetre  => 'cubic decimetre per cubic metre',
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
            self::Percent                      => '0.01',
            self::PartPerMillion               => '0.000001',
            self::PartPerBillionUS             => '0.000000001',
            self::PercentWeight                => '0.01',
            self::PartPerHundredThousand       => '0.00001',
            self::PartPerThousandPerMille      => '0.001',
            self::GramPerKilogram              => '0.001',
            self::MilligramPerKilogram         => '0.000001',
            self::MicrogramPerKilogram         => '0.000000001',
            self::NanogramPerKilogram          => '0.000000000001',
            self::KilogramPerKilogram          => '1',
            self::LitrePerLitre                => '1',
            self::MillilitrePerLitre           => '0.001',
            self::MicrolitrePerLitre           => '0.000001',
            self::CubicMetrePerCubicMetre      => '1',
            self::MillilitrePerCubicMetre      => '0.000001',
            self::CubicCentimetrePerCubicMetre => '0.000001',
            self::CubicMillimetrePerCubicMetre => '0.000000001',
            self::CubicDecimetrePerCubicMetre  => '0.001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::DimensionlessConcentration;
    }
}
