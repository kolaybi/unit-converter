<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Exceptions;

final class NonConvertibleUnitException extends \LogicException
{
    public function __construct(string $unit)
    {
        parent::__construct(
            "Unit '{$unit}' is a packaging/non-convertible unit and cannot be used in conversions."
        );
    }
}
