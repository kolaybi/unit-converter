<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Wavenumber: string implements Unit
{
    case Dioptre              = 'Q25';
    case ReciprocalCentimetre = 'E90';
    case ReciprocalInch       = 'Q24';
    case TeethPerInch         = 'TPI';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Dioptre              => 'dpt',
            self::ReciprocalCentimetre => 'cm⁻¹',
            self::ReciprocalInch       => '1/in',
            self::TeethPerInch         => 'TPI',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Dioptre              => 'dioptre',
            self::ReciprocalCentimetre => 'reciprocal centimetre',
            self::ReciprocalInch       => 'reciprocal inch',
            self::TeethPerInch         => 'teeth per inch',
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
            self::Dioptre              => '1',
            self::ReciprocalCentimetre => '100',
            self::ReciprocalInch       => '39.3700787',
            self::TeethPerInch         => '39.3700787',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Wavenumber;
    }
}
