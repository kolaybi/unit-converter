<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Inductance: string implements Unit
{
    case Henry      = '81';
    case Millihenry = 'C14';
    case Microhenry = 'B90';
    case Nanohenry  = 'C43';
    case Picohenry  = 'C73';
    case Kilohenry  = 'P24';

    public function symbol(): string
    {
        return match ($this) {
            self::Henry      => 'H',
            self::Millihenry => 'mH',
            self::Microhenry => 'µH',
            self::Nanohenry  => 'nH',
            self::Picohenry  => 'pH',
            self::Kilohenry  => 'kH',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Henry      => 'henry',
            self::Millihenry => 'millihenry',
            self::Microhenry => 'microhenry',
            self::Nanohenry  => 'nanohenry',
            self::Picohenry  => 'picohenry',
            self::Kilohenry  => 'kilohenry',
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
            self::Henry      => '1',
            self::Millihenry => '0.001',
            self::Microhenry => '0.000001',
            self::Nanohenry  => '0.000000001',
            self::Picohenry  => '0.000000000001',
            self::Kilohenry  => '1000',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Inductance;
    }
}
