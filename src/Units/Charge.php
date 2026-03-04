<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Charge: string implements Unit
{
    case Coulomb                          = 'COU';
    case AmpereSecond                     = 'A8';
    case AmpereHour                       = 'AMH';
    case KiloampereHourThousandAmpereHour = 'TAH';
    case Megacoulomb                      = 'D77';
    case Millicoulomb                     = 'D86';
    case Kilocoulomb                      = 'B26';
    case Microcoulomb                     = 'B86';
    case Nanocoulomb                      = 'C40';
    case Picocoulomb                      = 'C71';
    case MilliampereHour                  = 'E09';
    case AmpereMinute                     = 'N95';
    case Franklin                         = 'N94';

    public function symbol(): string
    {
        return match ($this) {
            self::Coulomb                          => 'C',
            self::AmpereSecond                     => 'A·s',
            self::AmpereHour                       => 'A·h',
            self::KiloampereHourThousandAmpereHour => 'kA·h',
            self::Megacoulomb                      => 'MC',
            self::Millicoulomb                     => 'mC',
            self::Kilocoulomb                      => 'kC',
            self::Microcoulomb                     => 'µC',
            self::Nanocoulomb                      => 'nC',
            self::Picocoulomb                      => 'pC',
            self::MilliampereHour                  => 'mA·h',
            self::AmpereMinute                     => 'A·min',
            self::Franklin                         => 'Fr',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Coulomb                          => 'coulomb',
            self::AmpereSecond                     => 'ampere second',
            self::AmpereHour                       => 'ampere hour',
            self::KiloampereHourThousandAmpereHour => 'kiloampere hour (thousand ampere hour)',
            self::Megacoulomb                      => 'megacoulomb',
            self::Millicoulomb                     => 'millicoulomb',
            self::Kilocoulomb                      => 'kilocoulomb',
            self::Microcoulomb                     => 'microcoulomb',
            self::Nanocoulomb                      => 'nanocoulomb',
            self::Picocoulomb                      => 'picocoulomb',
            self::MilliampereHour                  => 'milliampere hour',
            self::AmpereMinute                     => 'ampere minute',
            self::Franklin                         => 'franklin',
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
            self::Coulomb                          => '1',
            self::AmpereSecond                     => '1',
            self::AmpereHour                       => '3600',
            self::KiloampereHourThousandAmpereHour => '3600000',
            self::Megacoulomb                      => '1000000',
            self::Millicoulomb                     => '0.001',
            self::Kilocoulomb                      => '1000',
            self::Microcoulomb                     => '0.000001',
            self::Nanocoulomb                      => '0.000000001',
            self::Picocoulomb                      => '0.000000000001',
            self::MilliampereHour                  => '3.6',
            self::AmpereMinute                     => '60',
            self::Franklin                         => '0.0000000003335641',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Charge;
    }
}
