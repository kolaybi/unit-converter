# Unit Converter

A PHP 8.4+ framework-agnostic package for converting between 2,216 units of measurement based on [UN/CEFACT Recommendation 20](https://unece.org/trade/uncefact/cl-recommendations), [Recommendation 21](https://unece.org/trade/uncefact/cl-recommendations) (package types), and the [GS1 unit conversion model](https://www.gs1.org/).

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

58 categories covering 2,216 units (780 convertible + 1,436 non-convertible):

| Category                    | Units | Category                   | Units |
|-----------------------------|-------|----------------------------|-------|
| Absorbed Dose               | 4     | Kinematic Viscosity        | 7     |
| Absorbed Dose Rate          | 11    | Length                     | 34    |
| Acceleration                | 11    | Luminous Intensity         | 3     |
| Amount of Substance         | 4     | Magnetic Flux              | 3     |
| Angle                       | 9     | Magnetic Flux Density      | 6     |
| Angular Impulse             | 3     | Magnetic Vector Potential  | 3     |
| Angular Velocity            | 4     | Mass                       | 34    |
| Area                        | 20    | Memory Capacity            | 15    |
| Capacitance                 | 7     | Molar Concentration        | 5     |
| Charge                      | 13    | Molar Mass                 | 2     |
| Conductance                 | 7     | Molar Thermodynamic Energy | 2     |
| Counting                    | 14    | Molar Volume               | 4     |
| Current                     | 9     | Package Type ⊘             | 406   |
| Data Rate                   | 12    | Packaging ⊘                | 52    |
| Density                     | 28    | Power                      | 44    |
| Dimensionless Concentration | 24    | Pressure                   | 42    |
| Dynamic Viscosity           | 19    | Radioactivity              | 9     |
| Effective Dose              | 4     | Resistance                 | 8     |
| Effective Dose Rate         | 13    | Signal Rate                | 3     |
| Energy                      | 34    | Specific Volume            | 7     |
| Energy Density              | 7     | Speed                      | 23    |
| Exposure                    | 2     | Temperature                | 4     |
| Flow Rate                   | 93    | Textile Density            | 3     |
| Force                       | 15    | Time                       | 18    |
| Frequency                   | 10    | Torque                     | 16    |
| Illuminance                 | 6     | Trade ⊘                    | 978   |
| Impulse                     | 6     | Voltage                    | 6     |
| Inductance                  | 6     | Volume                     | 66    |
| Irradiance                  | 14    | Wavenumber                 | 4     |

⊘ = non-convertible (code resolution only)

## Package Types (Rec 21)

406 package types from [UNECE Recommendation 21](https://unece.org/trade/uncefact/cl-recommendations) (Rev. 12) are available via the `PackageType` enum.

Per Rec 20 guidance, each 2-character Rec 21 code is prefixed with `X` to form a 3-character unit-of-measure code (reserved range `X00`–`XZZ`). The native Rec 21 code is also available as an alias.

```php
use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\Units\PackageType;

// Using X-prefixed code
$unit = Converter::unit('XBG');  // PackageType::Bag
$unit->code();                   // 'XBG'
$unit->rec21Code();              // 'BG'
$unit->label();                  // 'bag'

// Using label
$unit = Converter::unit('aerosol'); // PackageType::Aerosol (code: XAE)

// Using enum case directly
$unit = PackageType::DrumSteel;     // code: X1A
```

> **Resolution priority:** When a Rec 21 native code conflicts with a Rec 20 code (23 shared codes like `BG`, `DR`, `TU`), Rec 20 takes priority. Use the X-prefixed code to explicitly target the Rec 21 entry.

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
Converter::convert(1)->from('not_a_real_unit')->to('abc');
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

The convertible unit enums are generated from the GS1 datatable:

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
