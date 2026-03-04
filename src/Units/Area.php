<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Area: string implements Unit
{
    case SquareMetre                   = 'MTK';
    case SquareKilometre               = 'KMK';
    case SquareMicrometreSquareMicron  = 'H30';
    case Decare                        = 'DAA';
    case SquareCentimetre              = 'CMK';
    case SquareDecimetre               = 'DMK';
    case SquareDecametre               = 'H16';
    case SquareHectometre              = 'H18';
    case SquareMillimetre              = 'MMK';
    case Are                           = 'ARE';
    case Hectare                       = 'HAR';
    case SquareInch                    = 'INK';
    case SquareFoot                    = 'FTK';
    case SquareYard                    = 'YDK';
    case SquareMileStatuteMile         = 'MIK';
    case SquareMileBasedOnUsSurveyFoot = 'M48';
    case Acre                          = 'ACR';
    case CircularMil                   = 'M47';
    case BaseBox                       = 'BB';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return match ($this) {
            self::SquareMetre                   => 'm²',
            self::SquareKilometre               => 'km²',
            self::SquareMicrometreSquareMicron  => 'µm²',
            self::Decare                        => 'daa',
            self::SquareCentimetre              => 'cm²',
            self::SquareDecimetre               => 'dm²',
            self::SquareDecametre               => 'dam²',
            self::SquareHectometre              => 'hm²',
            self::SquareMillimetre              => 'mm²',
            self::Are                           => 'a',
            self::Hectare                       => 'ha',
            self::SquareInch                    => 'in²',
            self::SquareFoot                    => 'ft²',
            self::SquareYard                    => 'yd²',
            self::SquareMileStatuteMile         => 'mi²',
            self::SquareMileBasedOnUsSurveyFoot => 'mi² (US survey)',
            self::Acre                          => 'acre',
            self::CircularMil                   => 'cmil',
            self::BaseBox                       => 'base box',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::SquareMetre                   => 'square metre',
            self::SquareKilometre               => 'square kilometre',
            self::SquareMicrometreSquareMicron  => 'square micrometre (square micron)',
            self::Decare                        => 'decare',
            self::SquareCentimetre              => 'square centimetre',
            self::SquareDecimetre               => 'square decimetre',
            self::SquareDecametre               => 'square decametre',
            self::SquareHectometre              => 'square hectometre',
            self::SquareMillimetre              => 'square millimetre',
            self::Are                           => 'are',
            self::Hectare                       => 'hectare',
            self::SquareInch                    => 'square inch',
            self::SquareFoot                    => 'square foot',
            self::SquareYard                    => 'square yard',
            self::SquareMileStatuteMile         => 'square mile (statute mile)',
            self::SquareMileBasedOnUsSurveyFoot => 'square mile (based on U.S. survey foot) ',
            self::Acre                          => 'acre',
            self::CircularMil                   => 'circular mil',
            self::BaseBox                       => 'base box',
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
            self::SquareMetre                   => '1',
            self::SquareKilometre               => '1000000',
            self::SquareMicrometreSquareMicron  => '0.000000000001',
            self::Decare                        => '1000',
            self::SquareCentimetre              => '0.0001',
            self::SquareDecimetre               => '0.01',
            self::SquareDecametre               => '100',
            self::SquareHectometre              => '10000',
            self::SquareMillimetre              => '0.000001',
            self::Are                           => '100',
            self::Hectare                       => '10000',
            self::SquareInch                    => '0.00064516',
            self::SquareFoot                    => '0.09290304',
            self::SquareYard                    => '0.8361274',
            self::SquareMileStatuteMile         => '2589988',
            self::SquareMileBasedOnUsSurveyFoot => '2589998',
            self::Acre                          => '4046.873',
            self::CircularMil                   => '0.0000000005067075',
            self::BaseBox                       => '20.2322176',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Area;
    }
}
