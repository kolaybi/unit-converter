<?php

declare(strict_types=1);

/**
 * Generates PHP enum files from the GS1 unit conversion datatable JSON.
 *
 * Usage: php bin/generate-enums.php [path-to-json]
 *
 * Default JSON path: ./bin/unit_coverter_datatable.json
 */
$jsonPath = $argv[1] ?? 'bin/unit_coverter_datatable.json';

if (!file_exists($jsonPath)) {
    fwrite(STDERR, "JSON file not found: {$jsonPath}\n");

    exit(1);
}

// Decode JSON preserving numeric precision by quoting numbers first
$raw = file_get_contents($jsonPath);
$raw = preg_replace('/"(multiplier|offset)":\s*(-?\d+(?:\.\d+)?(?:[eE][+-]?\d+)?)\s*/', '"$1": "$2"', $raw);
$data = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);

$typeToEnum = [
    'absorbed dose'               => 'AbsorbedDose',
    'absorbed dose rate'          => 'AbsorbedDoseRate',
    'acceleration'                => 'Acceleration',
    'amount of substance'         => 'AmountOfSubstance',
    'angle'                       => 'Angle',
    'angular impulse'             => 'AngularImpulse',
    'angular velocity'            => 'AngularVelocity',
    'area'                        => 'Area',
    'capacitance'                 => 'Capacitance',
    'charge'                      => 'Charge',
    'conductance'                 => 'Conductance',
    'current'                     => 'Current',
    'data rate'                   => 'DataRate',
    'density, humidity'           => 'Density',
    'dimensionless concentration' => 'DimensionlessConcentration',
    'dynamic viscosity'           => 'DynamicViscosity',
    'effective dose'              => 'EffectiveDose',
    'effective dose rate'         => 'EffectiveDoseRate',
    'energy'                      => 'Energy',
    'energy density'              => 'EnergyDensity',
    'exposure'                    => 'Exposure',
    'flow rate'                   => 'FlowRate',
    'force'                       => 'Force',
    'frequency'                   => 'Frequency',
    'illuminance'                 => 'Illuminance',
    'impulse'                     => 'Impulse',
    'inductance'                  => 'Inductance',
    'irradiance'                  => 'Irradiance',
    'kinematic viscosity'         => 'KinematicViscosity',
    'length'                      => 'Length',
    'luminous intensity'          => 'LuminousIntensity',
    'magnetic flux'               => 'MagneticFlux',
    'magnetic flux density'       => 'MagneticFluxDensity',
    'magnetic vector potential'   => 'MagneticVectorPotential',
    'mass'                        => 'Mass',
    'memory capacity'             => 'MemoryCapacity',
    'molar concentration'         => 'MolarConcentration',
    'molar mass'                  => 'MolarMass',
    'molar thermodynamic energy'  => 'MolarThermodynamicEnergy',
    'molar volume'                => 'MolarVolume',
    'power'                       => 'Power',
    'pressure'                    => 'Pressure',
    'radioactivity'               => 'Radioactivity',
    'resistance'                  => 'Resistance',
    'specific volume'             => 'SpecificVolume',
    'speed'                       => 'Speed',
    'temperature'                 => 'Temperature',
    'time'                        => 'Time',
    'torque'                      => 'Torque',
    'voltage'                     => 'Voltage',
    'volume'                      => 'Volume',
];

$typeToCategory = [
    'absorbed dose'               => 'AbsorbedDose',
    'absorbed dose rate'          => 'AbsorbedDoseRate',
    'acceleration'                => 'Acceleration',
    'amount of substance'         => 'AmountOfSubstance',
    'angle'                       => 'Angle',
    'angular impulse'             => 'AngularImpulse',
    'angular velocity'            => 'AngularVelocity',
    'area'                        => 'Area',
    'capacitance'                 => 'Capacitance',
    'charge'                      => 'Charge',
    'conductance'                 => 'Conductance',
    'current'                     => 'Current',
    'data rate'                   => 'DataRate',
    'density, humidity'           => 'Density',
    'dimensionless concentration' => 'DimensionlessConcentration',
    'dynamic viscosity'           => 'DynamicViscosity',
    'effective dose'              => 'EffectiveDose',
    'effective dose rate'         => 'EffectiveDoseRate',
    'energy'                      => 'Energy',
    'energy density'              => 'EnergyDensity',
    'exposure'                    => 'Exposure',
    'flow rate'                   => 'FlowRate',
    'force'                       => 'Force',
    'frequency'                   => 'Frequency',
    'illuminance'                 => 'Illuminance',
    'impulse'                     => 'Impulse',
    'inductance'                  => 'Inductance',
    'irradiance'                  => 'Irradiance',
    'kinematic viscosity'         => 'KinematicViscosity',
    'length'                      => 'Length',
    'luminous intensity'          => 'LuminousIntensity',
    'magnetic flux'               => 'MagneticFlux',
    'magnetic flux density'       => 'MagneticFluxDensity',
    'magnetic vector potential'   => 'MagneticVectorPotential',
    'mass'                        => 'Mass',
    'memory capacity'             => 'MemoryCapacity',
    'molar concentration'         => 'MolarConcentration',
    'molar mass'                  => 'MolarMass',
    'molar thermodynamic energy'  => 'MolarThermodynamicEnergy',
    'molar volume'                => 'MolarVolume',
    'power'                       => 'Power',
    'pressure'                    => 'Pressure',
    'radioactivity'               => 'Radioactivity',
    'resistance'                  => 'Resistance',
    'specific volume'             => 'SpecificVolume',
    'speed'                       => 'Speed',
    'temperature'                 => 'Temperature',
    'time'                        => 'Time',
    'torque'                      => 'Torque',
    'voltage'                     => 'Voltage',
    'volume'                      => 'Volume',
];

// Group units by type
$grouped = [];
foreach ($data as $unit) {
    $type = $unit['type'];
    $grouped[$type][] = $unit;
}

$outputDir = __DIR__ . '/../src/Units';

$generated = 0;

foreach ($grouped as $type => $units) {
    if (!isset($typeToEnum[$type])) {
        fwrite(STDERR, "Warning: Unknown type '{$type}', skipping.\n");

        continue;
    }

    $enumName = $typeToEnum[$type];
    $categoryCase = $typeToCategory[$type];

    // Generate case names from unit names
    $cases = [];
    $usedNames = [];

    foreach ($units as $unit) {
        $caseName = toPascalCase($unit['name']);

        // Handle duplicates by appending the rec20 code
        if (isset($usedNames[$caseName])) {
            $caseName .= '_' . preg_replace('/[^A-Za-z0-9]/', '', $unit['rec20']);
        }
        $usedNames[$caseName] = true;

        // Use rec20 code as symbol fallback when GS1 data has '-' or empty
        $symbol = $unit['symbol'];
        if ('-' === $symbol || '' === $symbol || null === $symbol) {
            $symbol = $unit['rec20'];
        }

        $cases[] = [
            'caseName'   => $caseName,
            'rec20'      => $unit['rec20'],
            'name'       => $unit['name'],
            'symbol'     => $symbol,
            'multiplier' => normalizeNumber($unit['multiplier']),
            'offset'     => normalizeNumber($unit['offset']),
        ];
    }

    $content = generateEnum($enumName, $categoryCase, $cases);

    file_put_contents("{$outputDir}/{$enumName}.php", $content);
    $generated++;

    echo "{$enumName}: " . count($cases) . " cases\n";
}

echo "\nGenerated {$generated} enum files with " . count($data) . " total units.\n";

// --- Helper Functions ---

function toPascalCase(string $name): string
{
    // Strip common measurement prefixes that don't add value to case names
    $name = preg_replace('/^degrees?\s+/i', '', $name);

    // Clean up the name for PascalCase conversion
    $name = str_replace(['(', ')', ',', '/'], ' ', $name);

    // Remove trailing/leading whitespace
    $name = trim($name);

    // Split by spaces, hyphens, underscores
    $words = preg_split('/[\s\-_]+/', $name);

    $result = '';
    foreach ($words as $word) {
        if ('' === $word) {
            continue;
        }

        // Handle special abbreviations
        $upper = strtoupper($word);
        if (in_array($upper, ['UK', 'US', 'SI', 'AV', 'II', 'III', 'IV'])) {
            $result .= $upper;
        } else {
            $result .= ucfirst(strtolower($word));
        }
    }

    // Ensure the name starts with a letter (PHP enum case requirement)
    if ('' !== $result && preg_match('/^[0-9]/', $result)) {
        $result = '_' . $result;
    }

    // Ensure we have a valid identifier
    $result = preg_replace('/[^A-Za-z0-9_]/', '', $result);

    if ('' === $result) {
        $result = 'Unknown';
    }

    return $result;
}

function normalizeNumber(string $value): string
{
    // Expand scientific notation (e.g., 1e-9 → 0.000000001) for bcmath compatibility
    if (preg_match('/^(-?\d+(?:\.\d+)?)[eE]([+-]?\d+)$/', $value, $m)) {
        $value = expandScientific($m[1], (int) $m[2]);
    }

    // Remove trailing zeros after decimal point
    if (str_contains($value, '.')) {
        $value = rtrim($value, '0');
        $value = rtrim($value, '.');
    }

    // Normalize -0 to 0
    if ('-0' === $value) {
        return '0';
    }

    return $value;
}

function expandScientific(string $coefficient, int $exponent): string
{
    $negative = str_starts_with($coefficient, '-');
    $coefficient = ltrim($coefficient, '-');

    // Split coefficient into integer and fractional parts
    $parts = explode('.', $coefficient);
    $intPart = $parts[0];
    $fracPart = $parts[1] ?? '';

    $digits = $intPart . $fracPart;
    $dotPosition = strlen($intPart) + $exponent;

    if ($dotPosition <= 0) {
        // Need leading zeros: 0.000...digits
        $result = '0.' . str_repeat('0', abs($dotPosition)) . $digits;
    } elseif ($dotPosition >= strlen($digits)) {
        // All integer, pad with trailing zeros
        $result = $digits . str_repeat('0', $dotPosition - strlen($digits));
    } else {
        // Insert dot in the middle
        $result = substr($digits, 0, $dotPosition) . '.' . substr($digits, $dotPosition);
    }

    return ($negative ? '-' : '') . $result;
}

function generateEnum(string $enumName, string $categoryCase, array $cases): string
{
    $hasNonZeroOffset = false;
    foreach ($cases as $case) {
        if ('0' !== $case['offset']) {
            $hasNonZeroOffset = true;

            break;
        }
    }

    // Calculate alignment widths
    $maxCaseNameLen = 0;
    foreach ($cases as $case) {
        $len = strlen($case['caseName']);
        if ($len > $maxCaseNameLen) {
            $maxCaseNameLen = $len;
        }
    }

    $lines = [];
    $lines[] = '<?php';
    $lines[] = '';
    $lines[] = 'declare(strict_types=1);';
    $lines[] = '';
    $lines[] = 'namespace KolayBi\UnitConverter\Units;';
    $lines[] = '';
    $lines[] = 'use KolayBi\UnitConverter\Contracts\Unit;';
    $lines[] = 'use KolayBi\UnitConverter\Enums\UnitCategory;';
    $lines[] = '';
    $lines[] = "enum {$enumName}: string implements Unit";
    $lines[] = '{';

    // Cases
    foreach ($cases as $case) {
        $padded = str_pad($case['caseName'], $maxCaseNameLen);
        $lines[] = "    case {$padded} = '{$case['rec20']}';";
    }

    // code()
    $lines[] = '';
    $lines[] = '    public function code(): string';
    $lines[] = '    {';
    $lines[] = '        return $this->value;';
    $lines[] = '    }';

    // symbol()
    $lines[] = '';
    $lines[] = '    public function symbol(): string';
    $lines[] = '    {';
    $lines[] = '        return match ($this) {';
    foreach ($cases as $case) {
        $padded = str_pad('self::' . $case['caseName'], $maxCaseNameLen + 6);
        $symbol = addcslashes($case['symbol'], "'\\");
        $lines[] = "            {$padded} => '{$symbol}',";
    }
    $lines[] = '        };';
    $lines[] = '    }';

    // label()
    $lines[] = '';
    $lines[] = '    public function label(): string';
    $lines[] = '    {';
    $lines[] = '        return match ($this) {';
    foreach ($cases as $case) {
        $padded = str_pad('self::' . $case['caseName'], $maxCaseNameLen + 6);
        $label = addcslashes($case['name'], "'\\");
        $lines[] = "            {$padded} => '{$label}',";
    }
    $lines[] = '        };';
    $lines[] = '    }';

    // aliases()
    $lines[] = '';
    $lines[] = '    /**';
    $lines[] = '     * @return list<string>';
    $lines[] = '     */';
    $lines[] = '    public function aliases(): array';
    $lines[] = '    {';
    $lines[] = '        return [$this->value, $this->symbol(), $this->label()];';
    $lines[] = '    }';

    // multiplier()
    $lines[] = '';
    $lines[] = '    public function multiplier(): string';
    $lines[] = '    {';
    $lines[] = '        return match ($this) {';
    foreach ($cases as $case) {
        $padded = str_pad('self::' . $case['caseName'], $maxCaseNameLen + 6);
        $lines[] = "            {$padded} => '{$case['multiplier']}',";
    }
    $lines[] = '        };';
    $lines[] = '    }';

    // offset()
    $lines[] = '';
    $lines[] = '    public function offset(): string';
    $lines[] = '    {';
    if ($hasNonZeroOffset) {
        $lines[] = '        return match ($this) {';
        foreach ($cases as $case) {
            $padded = str_pad('self::' . $case['caseName'], $maxCaseNameLen + 6);
            $lines[] = "            {$padded} => '{$case['offset']}',";
        }
        $lines[] = '        };';
    } else {
        $lines[] = "        return '0';";
    }
    $lines[] = '    }';

    // category()
    $lines[] = '';
    $lines[] = '    public function category(): UnitCategory';
    $lines[] = '    {';
    $lines[] = "        return UnitCategory::{$categoryCase};";
    $lines[] = '    }';

    $lines[] = '}';
    $lines[] = '';

    return implode("\n", $lines);
}
