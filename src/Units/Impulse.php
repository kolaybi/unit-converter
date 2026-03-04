<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Impulse: string implements Unit
{
    case NewtonSecond                = 'C57';
    case KilogramMetrePerSecond      = 'B31';
    case KilogramCentimetrePerSecond = 'M98';
    case GramCentimetrePerSecond     = 'M99';
    case PoundFootPerSecond          = 'N10';
    case PoundInchPerSecond          = 'N11';

    public function symbol(): string
    {
        return match ($this) {
            self::NewtonSecond                => 'Ns',
            self::KilogramMetrePerSecond      => 'kg·m/s',
            self::KilogramCentimetrePerSecond => 'kg·cm/s',
            self::GramCentimetrePerSecond     => 'g·cm/s',
            self::PoundFootPerSecond          => 'lb·ft/s',
            self::PoundInchPerSecond          => 'lb·in/s',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::NewtonSecond                => 'newton second',
            self::KilogramMetrePerSecond      => 'kilogram metre per second',
            self::KilogramCentimetrePerSecond => 'kilogram centimetre per second',
            self::GramCentimetrePerSecond     => 'gram centimetre per second',
            self::PoundFootPerSecond          => 'pound foot per second',
            self::PoundInchPerSecond          => 'pound inch per second',
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
            self::NewtonSecond                => '1',
            self::KilogramMetrePerSecond      => '1',
            self::KilogramCentimetrePerSecond => '0.01',
            self::GramCentimetrePerSecond     => '0.00001',
            self::PoundFootPerSecond          => '0.138255',
            self::PoundInchPerSecond          => '0.01152125',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Impulse;
    }
}
