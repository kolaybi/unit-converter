<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum DataRate: string implements Unit
{
    case BitSecond      = 'B10';
    case KilobitSecond  = 'C74';
    case MegabitSecond  = 'E20';
    case GigabitSecond  = 'B80';
    case TerabitSecond  = 'B84';
    case PetabitSecond  = 'E79';
    case ExabitSecond   = 'E58';
    case ByteSecond     = 'P93';
    case KilobyteSecond = 'P94';
    case MegabyteSecond = 'P95';
    case GigabyteSecond = 'E68';
    case OctetSecond    = 'Q13';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::BitSecond      => 'bit/s',
            self::KilobitSecond  => 'kbit/s',
            self::MegabitSecond  => 'Mbit/s',
            self::GigabitSecond  => 'Gbit/s',
            self::TerabitSecond  => 'Tbit/s',
            self::PetabitSecond  => 'Pbit/s',
            self::ExabitSecond   => 'Ebit/s',
            self::ByteSecond     => 'byte/s',
            self::KilobyteSecond => 'kbyte/s',
            self::MegabyteSecond => 'Mbyte/s',
            self::GigabyteSecond => 'Gbyte/s',
            self::OctetSecond    => 'o/s',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::BitSecond      => 'bit/second',
            self::KilobitSecond  => 'kilobit/second',
            self::MegabitSecond  => 'megabit/second',
            self::GigabitSecond  => 'gigabit/second',
            self::TerabitSecond  => 'terabit/second',
            self::PetabitSecond  => 'petabit/second',
            self::ExabitSecond   => 'exabit/second',
            self::ByteSecond     => 'byte/second',
            self::KilobyteSecond => 'kilobyte/second',
            self::MegabyteSecond => 'megabyte/second',
            self::GigabyteSecond => 'gigabyte/second',
            self::OctetSecond    => 'octet/second',
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
            self::BitSecond      => '1',
            self::KilobitSecond  => '1000',
            self::MegabitSecond  => '1000000',
            self::GigabitSecond  => '1000000000',
            self::TerabitSecond  => '1000000000000',
            self::PetabitSecond  => '1000000000000000',
            self::ExabitSecond   => '1000000000000000000',
            self::ByteSecond     => '8',
            self::KilobyteSecond => '8000',
            self::MegabyteSecond => '8000000',
            self::GigabyteSecond => '8000000000',
            self::OctetSecond    => '8',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::DataRate;
    }
}
