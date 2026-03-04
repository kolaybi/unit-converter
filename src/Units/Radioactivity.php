<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Radioactivity: string implements Unit
{
    case Curie          = 'CUR';
    case Millicurie     = 'MCU';
    case Microcurie     = 'M5';
    case Kilocurie      = '2R';
    case Becquerel      = 'BQL';
    case Gigabecquerel  = 'GBQ';
    case Kilobecquerel  = '2Q';
    case Megabecquerel  = '4N';
    case Microbecquerel = 'H08';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Curie          => 'Ci',
            self::Millicurie     => 'mCi',
            self::Microcurie     => 'µCi',
            self::Kilocurie      => 'kCi',
            self::Becquerel      => 'Bq',
            self::Gigabecquerel  => 'GBq',
            self::Kilobecquerel  => 'kBq',
            self::Megabecquerel  => 'MBq',
            self::Microbecquerel => 'µBq',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Curie          => 'curie',
            self::Millicurie     => 'millicurie',
            self::Microcurie     => 'microcurie',
            self::Kilocurie      => 'kilocurie',
            self::Becquerel      => 'becquerel',
            self::Gigabecquerel  => 'gigabecquerel',
            self::Kilobecquerel  => 'kilobecquerel',
            self::Megabecquerel  => 'megabecquerel',
            self::Microbecquerel => 'microbecquerel',
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
            self::Curie          => '37000000000',
            self::Millicurie     => '37000000',
            self::Microcurie     => '37000',
            self::Kilocurie      => '37000000000000',
            self::Becquerel      => '1',
            self::Gigabecquerel  => '1000000000',
            self::Kilobecquerel  => '1000',
            self::Megabecquerel  => '1000000',
            self::Microbecquerel => '0.000001',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Radioactivity;
    }
}
