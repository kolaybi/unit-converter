# Changelog

All notable changes to this project will be documented in this file.

## [v1.0.0](https://github.com/kolaybi/unit-converter/commits/v1.0.0)  (2026-03-04)

### Added
- Fluent conversion API: `Converter::convert($value)->from($unit)->to($unit)`
- 53 unit categories covering 743 units based on UN/CEFACT Recommendation 20
- Arbitrary-precision math using bcmath (scale 20)
- GS1 multiplier + offset conversion model supporting both linear and non-linear conversions
- `Converter::unit()` method for resolving units by code, symbol, or label
- Unit resolution by enum case, UN/CEFACT code, symbol, or label
- `ConversionResult` value object with `round()`, `toFloat()`, and `format()` methods
- `toAll()` method for converting to all units in the same category
- Packaging enum for 15 non-convertible packaging units
- Counting enum for 6 counting units (each, dozen, hundred, thousand, pair, set)
- Code generator (`bin/generate-enums.php`) for building unit enums from GS1 datatable
- PHPStan level 9 static analysis
- Exception classes: `UnitNotFoundException`, `IncompatibleUnitsException`, `NonConvertibleUnitException`

## Notes

This is the initial release of the this package
