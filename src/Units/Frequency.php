<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Frequency: string implements Unit
{
    case Hertz            = 'HTZ';
    case Kilohertz        = 'KHZ';
    case Megahertz        = 'MHZ';
    case Gigahertz        = 'A86';
    case Terahertz        = 'D29';
    case ReciprocalSecond = 'C97';
    case ReciprocalMinute = 'C94';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Hertz            => 'Hz',
            self::Kilohertz        => 'kHz',
            self::Megahertz        => 'MHz',
            self::Gigahertz        => 'GHz',
            self::Terahertz        => 'THz',
            self::ReciprocalSecond => '/s',
            self::ReciprocalMinute => '/min',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Hertz            => 'hertz',
            self::Kilohertz        => 'kilohertz',
            self::Megahertz        => 'megahertz',
            self::Gigahertz        => 'gigahertz',
            self::Terahertz        => 'terahertz',
            self::ReciprocalSecond => 'reciprocal second',
            self::ReciprocalMinute => 'reciprocal minute',
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
            self::Hertz            => '1',
            self::Kilohertz        => '1000',
            self::Megahertz        => '1000000',
            self::Gigahertz        => '1000000000',
            self::Terahertz        => '1000000000000',
            self::ReciprocalSecond => '1',
            self::ReciprocalMinute => '0.016666666666666666',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Frequency;
    }
}
