<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;
use KolayBi\UnitConverter\Exceptions\UnitNotFoundException;

final class UnitResolver
{
    /** @var array<string, Unit>|null */
    private static ?array $map = null;

    public static function resolve(string $input): Unit
    {
        $map = self::buildMap();

        // Try exact match first (case-sensitive for UN/CEFACT codes like 'mV' vs 'MV')
        if (isset($map[$input])) {
            return $map[$input];
        }

        // Try case-insensitive match
        $lower = strtolower($input);
        if (isset($map[$lower])) {
            return $map[$lower];
        }

        throw new UnitNotFoundException($input);
    }

    /**
     * @internal
     */
    public static function reset(): void
    {
        self::$map = null;
    }

    /**
     * @return array<string, Unit>
     */
    private static function buildMap(): array
    {
        if (null !== self::$map) {
            return self::$map;
        }

        self::$map = [];

        foreach (UnitCategory::cases() as $category) {
            $enumClass = $category->enumClass();

            if (!enum_exists($enumClass)) {
                continue;
            }

            foreach ($enumClass::cases() as $unit) {
                // Map by UN/CEFACT code (case-sensitive, last-writer-wins).
                // Categories are ordered so PackageType (Rec 21) loads first,
                // then Rec 20 categories overwrite any conflicting codes/aliases.
                self::$map[$unit->code()] = $unit;

                // Map by all aliases (case-insensitive, last-writer-wins)
                foreach ($unit->aliases() as $alias) {
                    self::$map[strtolower($alias)] = $unit;
                }
            }
        }

        return self::$map;
    }
}
