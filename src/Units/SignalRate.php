<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum SignalRate: string implements Unit
{
    case Baud     = 'J38';
    case Kilobaud = 'K50';
    case Megabaud = 'J54';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Baud     => 'Bd',
            self::Kilobaud => 'kBd',
            self::Megabaud => 'MBd',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Baud     => 'baud',
            self::Kilobaud => 'kilobaud',
            self::Megabaud => 'megabaud',
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
            self::Baud     => '1',
            self::Kilobaud => '1000',
            self::Megabaud => '1000000',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::SignalRate;
    }
}
