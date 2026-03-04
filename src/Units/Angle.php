<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Angle: string implements Unit
{
    case Radian      = 'C81';
    case Milliradian = 'C25';
    case Microradian = 'B97';
    case Gon         = 'A91';
    case Degree      = 'DD';
    case Minute      = 'D61';
    case Second      = 'D62';
    case Mil         = 'M43';
    case Revolution  = 'M44';

    public function symbol(): string
    {
        return match ($this) {
            self::Radian      => 'rad',
            self::Milliradian => 'mrad',
            self::Microradian => 'µrad',
            self::Gon         => 'gon',
            self::Degree      => 'º',
            self::Minute      => '\'',
            self::Second      => '"',
            self::Mil         => 'mil',
            self::Revolution  => 'rev',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Radian      => 'radian',
            self::Milliradian => 'milliradian',
            self::Microradian => 'microradian',
            self::Gon         => 'gon',
            self::Degree      => 'degree',
            self::Minute      => 'minute',
            self::Second      => 'second',
            self::Mil         => 'mil',
            self::Revolution  => 'revolution',
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
            self::Radian      => '1',
            self::Milliradian => '0.001',
            self::Microradian => '0.000001',
            self::Gon         => '0.01570796327',
            self::Degree      => '0.01745329252',
            self::Minute      => '0.0002908882087',
            self::Second      => '0.000004848136811',
            self::Mil         => '0.0009817477042',
            self::Revolution  => '6.283185307',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Angle;
    }
}
