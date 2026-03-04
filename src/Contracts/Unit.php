<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Contracts;

use KolayBi\UnitConverter\Enums\UnitCategory;

interface Unit
{
    /**
     * The UN/CEFACT Recommendation 20 code.
     */
    public function code(): string;

    public function symbol(): string;

    public function label(): string;

    /**
     * @return list<string>
     */
    public function aliases(): array;

    /**
     * @return numeric-string
     */
    public function multiplier(): string;

    /**
     * @return numeric-string
     */
    public function offset(): string;

    public function category(): UnitCategory;
}
