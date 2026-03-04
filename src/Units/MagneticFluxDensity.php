<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum MagneticFluxDensity: string implements Unit
{
    case Tesla      = 'D33';
    case Millitesla = 'C29';
    case Microtesla = 'D81';
    case Nanotesla  = 'C48';
    case Kilotesla  = 'P13';
    case Gamma      = 'P12';

    public function symbol(): string
    {
        return match ($this) {
            self::Tesla      => 'T',
            self::Millitesla => 'mT',
            self::Microtesla => 'µT',
            self::Nanotesla  => 'nT',
            self::Kilotesla  => 'kT',
            self::Gamma      => 'γ',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Tesla      => 'tesla',
            self::Millitesla => 'millitesla',
            self::Microtesla => 'microtesla',
            self::Nanotesla  => 'nanotesla',
            self::Kilotesla  => 'kilotesla',
            self::Gamma      => 'gamma',
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
            self::Tesla      => '1',
            self::Millitesla => '0.001',
            self::Microtesla => '0.000001',
            self::Nanotesla  => '0.000000001',
            self::Kilotesla  => '1000',
            self::Gamma      => '0.000000001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::MagneticFluxDensity;
    }
}
