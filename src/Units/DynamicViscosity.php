<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum DynamicViscosity: string implements Unit
{
    case Poise                         = '89';
    case MillipascalSecond             = 'C24';
    case PascalSecond                  = 'C65';
    case Centipoise                    = 'C7';
    case Micropoise                    = 'J32';
    case PoundPerFootHour              = 'K67';
    case PoundPerFootSecond            = 'K68';
    case PoundForceSecondPerSquareFoot = 'K91';
    case PoundForceSecondPerSquareInch = 'K92';
    case SlugPerFootSecond             = 'L64';
    case PoundalSecondPerSquareFoot    = 'N34';
    case NewtonSecondPerSquareMetre    = 'N36';
    case KilogramPerMetreMinute        = 'N38';
    case KilogramPerMetreDay           = 'N39';
    case KilogramPerMetreHour          = 'N40';
    case GramPerCentimetreSecond       = 'N41';
    case PoundalSecondPerSquareInch    = 'N42';
    case PoundPerFootMinute            = 'N43';
    case PoundPerFootDay               = 'N44';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Poise                         => 'P',
            self::MillipascalSecond             => 'mPa·s',
            self::PascalSecond                  => 'Pa·s',
            self::Centipoise                    => 'cP',
            self::Micropoise                    => 'µP',
            self::PoundPerFootHour              => 'lb/(ft·h)',
            self::PoundPerFootSecond            => 'lb/(ft·s)',
            self::PoundForceSecondPerSquareFoot => 'lbf·s/ft²',
            self::PoundForceSecondPerSquareInch => 'lbf·s/in²',
            self::SlugPerFootSecond             => 'slug/(ft·s)',
            self::PoundalSecondPerSquareFoot    => '(pdl/ft²)·s',
            self::NewtonSecondPerSquareMetre    => '(N/m²)·s',
            self::KilogramPerMetreMinute        => 'kg/(m·min)',
            self::KilogramPerMetreDay           => 'kg/(m·d)',
            self::KilogramPerMetreHour          => 'kg/(m·h)',
            self::GramPerCentimetreSecond       => 'g/(cm·s)',
            self::PoundalSecondPerSquareInch    => '(pdl/in²)·s',
            self::PoundPerFootMinute            => 'lb/(ft·min)',
            self::PoundPerFootDay               => 'lb/(ft·d)',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Poise                         => 'poise',
            self::MillipascalSecond             => 'millipascal second',
            self::PascalSecond                  => 'pascal second',
            self::Centipoise                    => 'centipoise',
            self::Micropoise                    => 'micropoise',
            self::PoundPerFootHour              => 'pound per foot hour',
            self::PoundPerFootSecond            => 'pound per foot second',
            self::PoundForceSecondPerSquareFoot => 'pound-force second per square foot',
            self::PoundForceSecondPerSquareInch => 'pound-force second per square inch',
            self::SlugPerFootSecond             => 'slug per foot second',
            self::PoundalSecondPerSquareFoot    => 'poundal second per square foot ',
            self::NewtonSecondPerSquareMetre    => 'newton second per square metre',
            self::KilogramPerMetreMinute        => 'kilogram per metre minute',
            self::KilogramPerMetreDay           => 'kilogram per metre day',
            self::KilogramPerMetreHour          => 'kilogram per metre hour',
            self::GramPerCentimetreSecond       => 'gram per centimetre second',
            self::PoundalSecondPerSquareInch    => 'poundal second per square inch',
            self::PoundPerFootMinute            => 'pound per foot minute',
            self::PoundPerFootDay               => 'pound per foot day',
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
            self::Poise                         => '0.1',
            self::MillipascalSecond             => '0.001',
            self::PascalSecond                  => '1',
            self::Centipoise                    => '0.001',
            self::Micropoise                    => '0.000001',
            self::PoundPerFootHour              => '0.0004133789',
            self::PoundPerFootSecond            => '1.488164',
            self::PoundForceSecondPerSquareFoot => '47.88026',
            self::PoundForceSecondPerSquareInch => '6894.757',
            self::SlugPerFootSecond             => '47.88026',
            self::PoundalSecondPerSquareFoot    => '1.488164',
            self::NewtonSecondPerSquareMetre    => '1',
            self::KilogramPerMetreMinute        => '0.0166667',
            self::KilogramPerMetreDay           => '0.0000115741',
            self::KilogramPerMetreHour          => '0.000277778',
            self::GramPerCentimetreSecond       => '0.1',
            self::PoundalSecondPerSquareInch    => '214.2957',
            self::PoundPerFootMinute            => '0.02480273',
            self::PoundPerFootDay               => '0.00001722412',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::DynamicViscosity;
    }
}
