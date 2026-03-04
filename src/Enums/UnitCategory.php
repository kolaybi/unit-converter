<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Enums;

use KolayBi\UnitConverter\Units;

enum UnitCategory: string
{
    case AbsorbedDose = 'absorbed_dose';
    case AbsorbedDoseRate = 'absorbed_dose_rate';
    case Acceleration = 'acceleration';
    case AmountOfSubstance = 'amount_of_substance';
    case Angle = 'angle';
    case AngularImpulse = 'angular_impulse';
    case AngularVelocity = 'angular_velocity';
    case Area = 'area';
    case Capacitance = 'capacitance';
    case Charge = 'charge';
    case Conductance = 'conductance';
    case Counting = 'counting';
    case Current = 'current';
    case DataRate = 'data_rate';
    case Density = 'density';
    case DimensionlessConcentration = 'dimensionless_concentration';
    case DynamicViscosity = 'dynamic_viscosity';
    case EffectiveDose = 'effective_dose';
    case EffectiveDoseRate = 'effective_dose_rate';
    case Energy = 'energy';
    case EnergyDensity = 'energy_density';
    case Exposure = 'exposure';
    case FlowRate = 'flow_rate';
    case Force = 'force';
    case Frequency = 'frequency';
    case Illuminance = 'illuminance';
    case Impulse = 'impulse';
    case Inductance = 'inductance';
    case Irradiance = 'irradiance';
    case KinematicViscosity = 'kinematic_viscosity';
    case Length = 'length';
    case LuminousIntensity = 'luminous_intensity';
    case MagneticFlux = 'magnetic_flux';
    case MagneticFluxDensity = 'magnetic_flux_density';
    case MagneticVectorPotential = 'magnetic_vector_potential';
    case Mass = 'mass';
    case MemoryCapacity = 'memory_capacity';
    case MolarConcentration = 'molar_concentration';
    case MolarMass = 'molar_mass';
    case MolarThermodynamicEnergy = 'molar_thermodynamic_energy';
    case MolarVolume = 'molar_volume';
    case Packaging = 'packaging';
    case Power = 'power';
    case Pressure = 'pressure';
    case Radioactivity = 'radioactivity';
    case Resistance = 'resistance';
    case SpecificVolume = 'specific_volume';
    case Speed = 'speed';
    case Temperature = 'temperature';
    case Time = 'time';
    case Torque = 'torque';
    case Voltage = 'voltage';
    case Volume = 'volume';

    /** @return class-string<\UnitEnum&\KolayBi\UnitConverter\Contracts\Unit> */
    public function enumClass(): string
    {
        return match ($this) {
            self::AbsorbedDose => Units\AbsorbedDose::class,
            self::AbsorbedDoseRate => Units\AbsorbedDoseRate::class,
            self::Acceleration => Units\Acceleration::class,
            self::AmountOfSubstance => Units\AmountOfSubstance::class,
            self::Angle => Units\Angle::class,
            self::AngularImpulse => Units\AngularImpulse::class,
            self::AngularVelocity => Units\AngularVelocity::class,
            self::Area => Units\Area::class,
            self::Capacitance => Units\Capacitance::class,
            self::Charge => Units\Charge::class,
            self::Conductance => Units\Conductance::class,
            self::Counting => Units\Counting::class,
            self::Current => Units\Current::class,
            self::DataRate => Units\DataRate::class,
            self::Density => Units\Density::class,
            self::DimensionlessConcentration => Units\DimensionlessConcentration::class,
            self::DynamicViscosity => Units\DynamicViscosity::class,
            self::EffectiveDose => Units\EffectiveDose::class,
            self::EffectiveDoseRate => Units\EffectiveDoseRate::class,
            self::Energy => Units\Energy::class,
            self::EnergyDensity => Units\EnergyDensity::class,
            self::Exposure => Units\Exposure::class,
            self::FlowRate => Units\FlowRate::class,
            self::Force => Units\Force::class,
            self::Frequency => Units\Frequency::class,
            self::Illuminance => Units\Illuminance::class,
            self::Impulse => Units\Impulse::class,
            self::Inductance => Units\Inductance::class,
            self::Irradiance => Units\Irradiance::class,
            self::KinematicViscosity => Units\KinematicViscosity::class,
            self::Length => Units\Length::class,
            self::LuminousIntensity => Units\LuminousIntensity::class,
            self::MagneticFlux => Units\MagneticFlux::class,
            self::MagneticFluxDensity => Units\MagneticFluxDensity::class,
            self::MagneticVectorPotential => Units\MagneticVectorPotential::class,
            self::Mass => Units\Mass::class,
            self::MemoryCapacity => Units\MemoryCapacity::class,
            self::MolarConcentration => Units\MolarConcentration::class,
            self::MolarMass => Units\MolarMass::class,
            self::MolarThermodynamicEnergy => Units\MolarThermodynamicEnergy::class,
            self::MolarVolume => Units\MolarVolume::class,
            self::Packaging => Units\Packaging::class,
            self::Power => Units\Power::class,
            self::Pressure => Units\Pressure::class,
            self::Radioactivity => Units\Radioactivity::class,
            self::Resistance => Units\Resistance::class,
            self::SpecificVolume => Units\SpecificVolume::class,
            self::Speed => Units\Speed::class,
            self::Temperature => Units\Temperature::class,
            self::Time => Units\Time::class,
            self::Torque => Units\Torque::class,
            self::Voltage => Units\Voltage::class,
            self::Volume => Units\Volume::class,
        };
    }

    public function isConvertible(): bool
    {
        return $this !== self::Packaging;
    }
}
