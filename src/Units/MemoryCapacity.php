<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum MemoryCapacity: string implements Unit
{
    case Byte     = 'AD';
    case Octet    = 'Q12';
    case Kilobyte = '2P';
    case Megabyte = '4L';
    case Gigabyte = 'E34';
    case Terabyte = 'E35';
    case Kibibyte = 'E64';
    case Mebibyte = 'E63';
    case Gibibyte = 'E62';
    case Tebibyte = 'E61';
    case Pebibyte = 'E60';
    case Exbibyte = 'E59';
    case Bit     = 'A99';
    case Kilobit = 'C37';
    case Gigabit = 'B68';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Byte     => 'byte',
            self::Octet    => 'o',
            self::Kilobyte => 'kbyte',
            self::Megabyte => 'Mbyte',
            self::Gigabyte => 'Gbyte',
            self::Terabyte => 'Tbyte',
            self::Kibibyte => 'Kibyte',
            self::Mebibyte => 'Mibyte',
            self::Gibibyte => 'Gibyte',
            self::Tebibyte => 'Tibyte',
            self::Pebibyte => 'Pibyte',
            self::Exbibyte => 'Eibyte',
            self::Bit      => 'bit',
            self::Kilobit  => 'kbit',
            self::Gigabit  => 'Gbit',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Byte     => 'byte',
            self::Octet    => 'octet',
            self::Kilobyte => 'kilobyte',
            self::Megabyte => 'megabyte',
            self::Gigabyte => 'gigabyte',
            self::Terabyte => 'terabyte',
            self::Kibibyte => 'kibibyte',
            self::Mebibyte => 'mebibyte',
            self::Gibibyte => 'gibibyte',
            self::Tebibyte => 'tebibyte',
            self::Pebibyte => 'pebibyte',
            self::Exbibyte => 'exbibyte',
            self::Bit      => 'bit',
            self::Kilobit  => 'kilobit',
            self::Gigabit  => 'gigabit',
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
            self::Byte     => '1',
            self::Octet    => '1',
            self::Kilobyte => '1000',
            self::Megabyte => '1000000',
            self::Gigabyte => '1000000000',
            self::Terabyte => '1000000000000',
            self::Kibibyte => '1024',
            self::Mebibyte => '1048576',
            self::Gibibyte => '1073741824',
            self::Tebibyte => '1099511627776',
            self::Pebibyte => '1125899906842624',
            self::Exbibyte => '1152921504606847000',
            self::Bit      => '0.125',
            self::Kilobit  => '125',
            self::Gigabit  => '125000000',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::MemoryCapacity;
    }
}
