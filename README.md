# Unit Converter

A PHP 8.4+ framework-agnostic package for converting between 743 units of measurement based on [UN/CEFACT Recommendation 20](https://unece.org/trade/uncefact/cl-recommendations) and the [GS1 unit conversion model](https://www.gs1.org/).

Uses arbitrary-precision math (bcmath) with the GS1 multiplier + offset formula to handle both linear conversions (mass, length, volume, etc.) and non-linear ones (temperature).

## Requirements

- PHP 8.4+
- ext-bcmath

## Installation

```bash
composer require kolaybi/unit-converter
```

## Quick Start

```php
use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\Units\Mass;
use KolayBi\UnitConverter\Units\Temperature;

// Using enum cases
$result = Converter::convert(10)->from(Mass::Kilogram)->to(Mass::Pound);
echo $result->round(2); // "22.05"

// Using UN/CEFACT codes
$result = Converter::convert(1)->from('KGM')->to('LBR');
echo $result->toFloat(); // 2.20462262...

// Using symbols
$result = Converter::convert(100)->from('°C')->to('°F');
echo $result->round(1); // "212.0"

// Using labels
$result = Converter::convert(1)->from('kilogram')->to('gram');
echo $result->value; // "1000.00000000000000000000"

// Default value is 1 — handy for conversion factors
$result = Converter::convert()->from(Mass::Kilogram)->to(Mass::Pound);
echo $result->round(6); // "2.204623"
```

## API

### `Converter::convert(int|float|string $value = 1): PendingConversion`

Entry point. Accepts any numeric value. Defaults to `1`, useful for looking up conversion factors.

### `PendingConversion::from(Unit|string $unit): self`

Set the source unit. Accepts an enum case, UN/CEFACT code, symbol, or label.

### `PendingConversion::to(Unit|string $unit): ConversionResult`

Convert to the target unit and return the result.

### `Converter::unit(string $input): Unit`

Resolve a unit by UN/CEFACT code, symbol, or label. Returns the `Unit` enum case.

```php
$unit = Converter::unit('kg');
$unit->code();   // 'KGM'
$unit->symbol(); // 'kg'
$unit->label();  // 'kilogram'
```

### `PendingConversion::toAll(): array<string, string>`

Convert to all other units in the same category. Returns an array keyed by UN/CEFACT code.

### `ConversionResult`

```php
$result->value;              // Full-precision string
$result->toFloat();          // PHP float
$result->round(2);           // "22.05"
$result->format(2, ',', '.'); // "1.234,57"
(string) $result;            // Same as ->value
$result->from;               // Source Unit enum
$result->to;                 // Target Unit enum
```

## Unit Categories

53 categories covering 743 units:

| Category                    | Units | Category                   | Units |
|-----------------------------|-------|----------------------------|-------|
| Absorbed Dose               | 4     | Kinematic Viscosity        | 7     |
| Absorbed Dose Rate          | 11    | Length                     | 27    |
| Acceleration                | 11    | Luminous Intensity         | 3     |
| Amount of Substance         | 4     | Magnetic Flux              | 3     |
| Angle                       | 9     | Magnetic Flux Density      | 6     |
| Angular Impulse             | 2     | Magnetic Vector Potential  | 3     |
| Angular Velocity            | 4     | Mass                       | 29    |
| Area                        | 19    | Memory Capacity            | 12    |
| Capacitance                 | 7     | Molar Concentration        | 5     |
| Charge                      | 13    | Molar Mass                 | 2     |
| Conductance                 | 7     | Molar Thermodynamic Energy | 2     |
| Counting                    | 6     | Molar Volume               | 4     |
| Current                     | 9     | Packaging                  | 15    |
| Data Rate                   | 12    | Power                      | 42    |
| Density                     | 28    | Pressure                   | 42    |
| Dimensionless Concentration | 19    | Radioactivity              | 9     |
| Dynamic Viscosity           | 19    | Resistance                 | 8     |
| Effective Dose              | 4     | Specific Volume            | 7     |
| Effective Dose Rate         | 13    | Speed                      | 23    |
| Energy                      | 34    | Temperature                | 4     |
| Energy Density              | 7     | Time                       | 16    |
| Exposure                    | 2     | Torque                     | 16    |
| Flow Rate                   | 88    | Voltage                    | 6     |
| Force                       | 15    | Volume                     | 66    |
| Frequency                   | 7     | Volume                     | 66    |
| Illuminance                 | 6     |                            |       |
| Impulse                     | 6     |                            |       |
| Inductance                  | 6     |                            |       |
| Irradiance                  | 14    |                            |       |

## Unit Resolution

Units can be resolved by:

- **Enum case**: `Mass::Kilogram`
- **UN/CEFACT code**: `'KGM'` (case-sensitive)
- **Symbol**: `'kg'` (case-insensitive)
- **Label**: `'kilogram'` (case-insensitive)

```php
// All equivalent
Converter::convert(1)->from(Mass::Kilogram)->to(Mass::Pound);
Converter::convert(1)->from('KGM')->to('LBR');
Converter::convert(1)->from('kg')->to('lb');
Converter::convert(1)->from('kilogram')->to('pound');
```

## Error Handling

```php
use KolayBi\UnitConverter\Exceptions\IncompatibleUnitsException;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;
use KolayBi\UnitConverter\Exceptions\UnitNotFoundException;

// Incompatible categories
Converter::convert(1)->from(Mass::Kilogram)->to(Temperature::Celsius);
// throws IncompatibleUnitsException

// Non-convertible units (packaging)
Converter::convert(1)->from(Packaging::Box)->to(Packaging::Bag);
// throws NonConvertibleUnitException

// Unknown unit string
Converter::convert(1)->from('xyz')->to('abc');
// throws UnitNotFoundException
```

## How It Works

All convertible units use the GS1 multiplier + offset model relative to a base unit per category:

```
base_value = input_value × multiplier + offset
output_value = (base_value - target_offset) ÷ target_multiplier
```

For most categories (mass, length, volume, etc.), the offset is 0, making it a simple ratio. Temperature uses non-zero offsets to handle Celsius (offset 273.15) and Fahrenheit (multiplier 5/9, offset 255.37).

All math uses `bcmath` with a scale of 20 decimal places.

## Code Generation

The 51 convertible unit enums are generated from the GS1 datatable:

```bash
php bin/generate-enums.php [path-to-json]
```

## Development

```bash
composer install
vendor/bin/phpunit           # Run tests
vendor/bin/phpstan analyse   # Static analysis (level 9)
vendor/bin/pint              # Code style
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/kolaybi/.github/blob/master/CONTRIBUTING.md) for details.

## License

Please see [License File](LICENSE.md) for more information.
