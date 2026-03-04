<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Conductance: string implements Unit
{
    case Siemens      = 'SIE';
    case Kilosiemens  = 'B53';
    case Millisiemens = 'C27';
    case Microsiemens = 'B99';
    case Picosiemens  = 'N92';
    case Mho          = 'NQ';
    case Micromho     = 'NR';

    public function symbol(): string
    {
        return match ($this) {
            self::Siemens      => 'S',
            self::Kilosiemens  => 'kS',
            self::Millisiemens => 'mS',
            self::Microsiemens => 'µS',
            self::Picosiemens  => 'pS',
            self::Mho          => 'mho',
            self::Micromho     => 'µmho',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Siemens      => 'siemens',
            self::Kilosiemens  => 'kilosiemens',
            self::Millisiemens => 'millisiemens',
            self::Microsiemens => 'microsiemens',
            self::Picosiemens  => 'picosiemens',
            self::Mho          => 'mho',
            self::Micromho     => 'micromho',
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
            self::Siemens      => '1',
            self::Kilosiemens  => '1000',
            self::Millisiemens => '0.001',
            self::Microsiemens => '0.000001',
            self::Picosiemens  => '0.000000000001',
            self::Mho          => '1',
            self::Micromho     => '0.000001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Conductance;
    }
}
