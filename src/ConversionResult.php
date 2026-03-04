<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter;

use KolayBi\UnitConverter\Contracts\Unit;
use Stringable;

final readonly class ConversionResult implements Stringable
{
    public function __construct(
        public string $value,
        public Unit $from,
        public Unit $to,
    ) {}

    public function __toString(): string
    {
        return $this->value;
    }

    public function round(int $precision = 2, int $mode = \PHP_ROUND_HALF_UP): string
    {
        return number_format(round((float) $this->value, $precision, $mode), $precision, '.', '');
    }

    public function toFloat(): float
    {
        return (float) $this->value;
    }

    public function format(
        int $decimals = 2,
        string $decimalSeparator = '.',
        string $thousandsSeparator = ',',
    ): string {
        return number_format(
            round((float) $this->value, $decimals),
            $decimals,
            $decimalSeparator,
            $thousandsSeparator,
        );
    }
}
