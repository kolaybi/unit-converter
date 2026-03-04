<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Exceptions\IncompatibleUnitsException;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;

final class PendingConversion
{
    private const int DEFAULT_SCALE = 20;

    private string $value;

    private ?Unit $sourceUnit = null;

    private ?string $baseValue = null;

    public function __construct(float|int|string $value)
    {
        $this->value = (string) $value;
    }

    public function from(string|Unit $unit): self
    {
        $unit = $this->resolveUnit($unit);
        $this->guardConvertible($unit);
        $this->sourceUnit = $unit;
        $this->baseValue = $this->toBase($this->value, $unit);

        return $this;
    }

    public function to(string|Unit $unit): ConversionResult
    {
        $unit = $this->resolveUnit($unit);
        $this->guardConvertible($unit);
        $this->guardCompatible($unit);

        $result = $this->fromBase($this->baseValue, $unit);

        return new ConversionResult($result, $this->sourceUnit, $unit);
    }

    /**
     * @return array<string, string>
     */
    public function toAll(): array
    {
        $category = $this->sourceUnit->category();
        $enumClass = $category->enumClass();
        $results = [];

        foreach ($enumClass::cases() as $targetUnit) {
            if ($targetUnit === $this->sourceUnit) {
                continue;
            }
            $results[$targetUnit->value] = $this->fromBase($this->baseValue, $targetUnit);
        }

        return $results;
    }

    private function toBase(string $value, Unit $unit): string
    {
        // base = value * multiplier + offset
        $multiplied = bcmul($value, $unit->multiplier(), self::DEFAULT_SCALE);

        return bcadd($multiplied, $unit->offset(), self::DEFAULT_SCALE);
    }

    private function fromBase(string $baseValue, Unit $unit): string
    {
        // value = (base - offset) / multiplier
        $subtracted = bcsub($baseValue, $unit->offset(), self::DEFAULT_SCALE);

        return bcdiv($subtracted, $unit->multiplier(), self::DEFAULT_SCALE);
    }

    private function resolveUnit(string|Unit $unit): Unit
    {
        if ($unit instanceof Unit) {
            return $unit;
        }

        return UnitResolver::resolve($unit);
    }

    private function guardConvertible(Unit $unit): void
    {
        if (!$unit->category()->isConvertible()) {
            throw new NonConvertibleUnitException($unit->value);
        }
    }

    private function guardCompatible(Unit $unit): void
    {
        if ($this->sourceUnit->category() !== $unit->category()) {
            throw new IncompatibleUnitsException(
                $this->sourceUnit->category()->value,
                $unit->category()->value,
            );
        }
    }
}
