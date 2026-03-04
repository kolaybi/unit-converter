<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Exceptions;

final class IncompatibleUnitsException extends \LogicException
{
    public function __construct(string $fromCategory, string $toCategory)
    {
        parent::__construct(
            "Cannot convert between incompatible unit categories: '{$fromCategory}' and '{$toCategory}'."
        );
    }
}
