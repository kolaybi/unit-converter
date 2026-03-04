<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter;

final class Converter
{
    public static function convert(float|int|string $value): PendingConversion
    {
        return new PendingConversion($value);
    }
}
