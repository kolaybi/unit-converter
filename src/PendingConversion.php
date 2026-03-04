<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Exceptions\IncompatibleUnitsException;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;
use LogicException;

final class PendingConversion
{
    private const int DEFAULT_SCALE = 20;

    /** @var numeric-string */
    private string $value;

    private ?Unit $sourceUnit = null;

    /** @var numeric-string|null */
    private ?string $baseValue = null;

    public function __construct(float|int|string $value)
    {
        /** @var numeric-string $numericValue */
        $numericValue = (string) $value;
        $this->value = $numericValue;
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
        $sourceUnit = $this->sourceUnit ?? throw new LogicException('Call from() before to().');
        $baseValue = $this->baseValue ?? throw new LogicException('Call from() before to().');

        $unit = $this->resolveUnit($unit);
        $this->guardConvertible($unit);
        $this->guardCompatible($sourceUnit, $unit);

        $result = $this->fromBase($baseValue, $unit);

        return new ConversionResult($result, $sourceUnit, $unit);
    }

    /**
     * @return array<string, string>
     */
    public function toAll(): array
    {
        $sourceUnit = $this->sourceUnit ?? throw new LogicException('Call from() before toAll().');
        $baseValue = $this->baseValue ?? throw new LogicException('Call from() before toAll().');

        $category = $sourceUnit->category();
        $enumClass = $category->enumClass();
        $results = [];

        foreach ($enumClass::cases() as $targetUnit) {
            if ($targetUnit === $sourceUnit) {
                continue;
            }
            $results[$targetUnit->code()] = $this->fromBase($baseValue, $targetUnit);
        }

        return $results;
    }

    /**
     * @param numeric-string $value
     *
     * @return numeric-string
     */
    private function toBase(string $value, Unit $unit): string
    {
        // base = value * multiplier + offset
        $multiplied = bcmul($value, $unit->multiplier(), self::DEFAULT_SCALE);

        /** @var numeric-string */
        return bcadd($multiplied, $unit->offset(), self::DEFAULT_SCALE);
    }

    /**
     * @param numeric-string $baseValue
     *
     * @return numeric-string
     */
    private function fromBase(string $baseValue, Unit $unit): string
    {
        // value = (base - offset) / multiplier
        $subtracted = bcsub($baseValue, $unit->offset(), self::DEFAULT_SCALE);

        /** @var numeric-string */
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
            throw new NonConvertibleUnitException($unit->code());
        }
    }

    private function guardCompatible(Unit $sourceUnit, Unit $targetUnit): void
    {
        if ($sourceUnit->category() !== $targetUnit->category()) {
            throw new IncompatibleUnitsException(
                $sourceUnit->category()->value,
                $targetUnit->category()->value,
            );
        }
    }
}
