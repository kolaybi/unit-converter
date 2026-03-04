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
    case Gross = 'GRO';
    case GreatGross = 'GGR';
    case Score = 'SCO';
    case Thousand = 'MIL';
    case Million = 'MIO';
    case Milliard = 'MLD';
    case BillionEUR = 'BIL';
    case TrillionEUR = 'TRL';

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
            self::Gross         => 'gr',
            self::GreatGross    => 'GGR',
            self::Score         => 'SCO',
            self::Thousand      => 'MIL',
            self::Million       => 'MIO',
            self::Milliard      => 'MLD',
            self::BillionEUR    => 'BIL',
            self::TrillionEUR   => 'TRL',
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
            self::Gross         => 'gross',
            self::GreatGross    => 'great gross',
            self::Score         => 'score',
            self::Thousand      => 'thousand',
            self::Million       => 'million',
            self::Milliard      => 'milliard',
            self::BillionEUR    => 'billion (EUR)',
            self::TrillionEUR   => 'trillion (EUR)',
        };
    }

    /**
     * @return list<string>
     */
    public function aliases(): array
    {
        $aliases = [$this->value, $this->symbol(), $this->label()];

        if ($this === self::Each) {
            $aliases[] = 'EA';
            $aliases[] = 'H87';
            $aliases[] = 'NAR';
        }

        return $aliases;
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
            self::Gross         => '144',
            self::GreatGross    => '1728',
            self::Score         => '20',
            self::Thousand      => '1000',
            self::Million       => '1000000',
            self::Milliard      => '1000000000',
            self::BillionEUR    => '1000000000000',
            self::TrillionEUR   => '1000000000000000000',
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
