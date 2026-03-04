<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Counting: string implements Unit
{
    case Each = 'C62';
    case Dozen = 'DZN';
    case Hundred = 'CEN';
    case ThousandPiece = 'T3';
    case Pair = 'PR';
    case Set = 'SET';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Each          => 'ea',
            self::Dozen         => 'doz',
            self::Hundred       => '100',
            self::ThousandPiece => '1000',
            self::Pair          => 'pr',
            self::Set           => 'set',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Each          => 'each',
            self::Dozen         => 'dozen',
            self::Hundred       => 'hundred',
            self::ThousandPiece => 'thousand piece',
            self::Pair          => 'pair',
            self::Set           => 'set',
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
            self::Each          => '1',
            self::Dozen         => '12',
            self::Hundred       => '100',
            self::ThousandPiece => '1000',
            self::Pair          => '2',
            self::Set           => '1',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Counting;
    }
}
