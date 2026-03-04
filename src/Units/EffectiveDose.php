<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum EffectiveDose: string implements Unit
{
    case Sievert                     = 'D13';
    case Millisievert                = 'C28';
    case Rem                         = 'D91';
    case MilliroentgenAequivalentMen = 'L31';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Sievert                     => 'Sv',
            self::Millisievert                => 'mSv',
            self::Rem                         => 'rem',
            self::MilliroentgenAequivalentMen => 'mrem',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Sievert                     => 'sievert',
            self::Millisievert                => 'millisievert',
            self::Rem                         => 'rem',
            self::MilliroentgenAequivalentMen => 'milliroentgen aequivalent men',
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
            self::Sievert                     => '1',
            self::Millisievert                => '0.001',
            self::Rem                         => '0.01',
            self::MilliroentgenAequivalentMen => '0.00001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::EffectiveDose;
    }
}
