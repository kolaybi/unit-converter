<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Capacitance: string implements Unit
{
    case Farad      = 'FAR';
    case Attofarad  = 'H48';
    case Millifarad = 'C10';
    case Microfarad = '4O';
    case Nanofarad  = 'C41';
    case Picofarad  = '4T';
    case Kilofarad  = 'N90';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Farad      => 'F',
            self::Attofarad  => 'aF',
            self::Millifarad => 'mF',
            self::Microfarad => 'µF',
            self::Nanofarad  => 'nF',
            self::Picofarad  => 'pF',
            self::Kilofarad  => 'kF',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Farad      => 'farad',
            self::Attofarad  => 'attofarad',
            self::Millifarad => 'millifarad',
            self::Microfarad => 'microfarad',
            self::Nanofarad  => 'nanofarad',
            self::Picofarad  => 'picofarad',
            self::Kilofarad  => 'kilofarad',
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
            self::Farad      => '1',
            self::Attofarad  => '0.000000000000000001',
            self::Millifarad => '0.001',
            self::Microfarad => '0.000001',
            self::Nanofarad  => '0.000000001',
            self::Picofarad  => '0.000000000001',
            self::Kilofarad  => '1000',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Capacitance;
    }
}
