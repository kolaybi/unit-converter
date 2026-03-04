<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter;

use KolayBi\UnitConverter\Contracts\Unit;

final class Converter
{
    public static function convert(float|int|string $value = 1): PendingConversion
    {
        return new PendingConversion($value);
    }

    public static function unit(string $input): Unit
    {
        return UnitResolver::resolve($input);
    }
}
