<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Exceptions;

use InvalidArgumentException;

final class UnitNotFoundException extends InvalidArgumentException
{
    public function __construct(string $unit)
    {
        parent::__construct("Unit '{$unit}' not found.");
    }
}
