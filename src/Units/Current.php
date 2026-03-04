<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Current: string implements Unit
{
    case Ampere      = 'AMP';
    case Kiloampere  = 'B22';
    case Megaampere  = 'H38';
    case Milliampere = '4K';
    case Microampere = 'B84';
    case Nanoampere  = 'C39';
    case Picoampere  = 'C70';
    case Biot        = 'N96';
    case Gilbert     = 'N97';

    public function symbol(): string
    {
        return match ($this) {
            self::Ampere      => 'A',
            self::Kiloampere  => 'kA',
            self::Megaampere  => 'MA',
            self::Milliampere => 'mA',
            self::Microampere => 'µA',
            self::Nanoampere  => 'nA',
            self::Picoampere  => 'pA',
            self::Biot        => 'Bi',
            self::Gilbert     => 'Gi',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Ampere      => 'ampere',
            self::Kiloampere  => 'kiloampere',
            self::Megaampere  => 'megaampere',
            self::Milliampere => 'milliampere',
            self::Microampere => 'microampere',
            self::Nanoampere  => 'nanoampere',
            self::Picoampere  => 'picoampere',
            self::Biot        => 'biot',
            self::Gilbert     => 'gilbert',
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
            self::Ampere      => '1',
            self::Kiloampere  => '1000',
            self::Megaampere  => '1000000',
            self::Milliampere => '0.001',
            self::Microampere => '0.000001',
            self::Nanoampere  => '0.000000001',
            self::Picoampere  => '0.000000000001',
            self::Biot        => '10',
            self::Gilbert     => '0.7957747',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Current;
    }
}
