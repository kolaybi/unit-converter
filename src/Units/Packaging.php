<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Packaging: string implements Unit
{
    case Box = 'BX';
    case Packet = 'PA';
    case Pack = 'PK';
    case Bag = 'BG';
    case Roll = 'RO';
    case Drum = 'DR';
    case Ball = 'AA';
    case Reel = 'RL';
    case Barrel = 'BLL';
    case LinearMetre = 'LM';
    case Tube = 'TU';
    case Bottle = 'BO';
    case Tin = 'TN';
    case Sack = 'SA';
    case Person = 'IE';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return $this->value;
    }

    public function label(): string
    {
        return match ($this) {
            self::Box         => 'box',
            self::Packet      => 'packet',
            self::Pack        => 'pack',
            self::Bag         => 'bag',
            self::Roll        => 'roll',
            self::Drum        => 'drum',
            self::Ball        => 'ball',
            self::Reel        => 'reel',
            self::Barrel      => 'barrel',
            self::LinearMetre => 'linear metre',
            self::Tube        => 'tube',
            self::Bottle      => 'bottle',
            self::Tin         => 'tin',
            self::Sack        => 'sack',
            self::Person      => 'person',
        };
    }

    /**
     * @return list<string>
     */
    public function aliases(): array
    {
        return [$this->value, $this->label()];
    }

    public function multiplier(): string
    {
        return '0';
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Packaging;
    }
}
