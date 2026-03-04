<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Contracts;

use KolayBi\UnitConverter\Enums\UnitCategory;

interface Unit
{
    public function symbol(): string;

    public function label(): string;

    /** @return list<string> */
    public function aliases(): array;

    public function multiplier(): string;

    public function offset(): string;

    public function category(): UnitCategory;
}
