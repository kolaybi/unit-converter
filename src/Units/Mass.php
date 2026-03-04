<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Mass: string implements Unit
{
    case Kilogram = 'KGM';
    case Kilotonne = 'KTN';
    case LongTon = 'LTN';
    case Megagram = '2U';
    case Tonne = 'TNE';
    case ShortTon = 'STN';
    case Decitonne = 'DTN';
    case Stone = 'STI';
    case Pound = 'LBR';
    case Hectogram = 'HGM';
    case Ounce = 'ONZ';
    case Decagram = 'DJ';
    case TroyOunce = 'APZ';
    case Gram = 'GRM';
    case Decigram = 'DG';
    case Centigram = 'CGM';
    case Milligram = 'MGM';
    case Microgram = 'MC';
    case Slug = 'F13';
    case HundredWeightUK = 'CWI';
    case HundredWeightUS = 'CWA';
    case Pfund = 'M86';
    case NetKilogram = '58';
    case DramUS = 'DRA';
    case DramUK = 'DRI';
    case GrossKilogram = 'E4';
    case Grain = 'GRN';
    case PoundNet = 'PN';
    case Pennyweight = 'DWT';

    public function symbol(): string
    {
        return match ($this) {
            self::Kilogram        => 'kg',
            self::Kilotonne       => 'kt',
            self::LongTon         => 'ton (UK)',
            self::Megagram        => 'Mg',
            self::Tonne           => 't',
            self::ShortTon        => 'ton (US)',
            self::Decitonne       => 'dt',
            self::Stone           => 'st',
            self::Pound           => 'lb',
            self::Hectogram       => 'hg',
            self::Ounce           => 'oz',
            self::Decagram        => 'dag',
            self::TroyOunce       => 'tr oz',
            self::Gram            => 'g',
            self::Decigram        => 'dg',
            self::Centigram       => 'cg',
            self::Milligram       => 'mg',
            self::Microgram       => 'µg',
            self::Slug            => 'slug',
            self::HundredWeightUK => 'cwt (UK)',
            self::HundredWeightUS => 'cwt (US)',
            self::Pfund           => 'pfd',
            self::NetKilogram     => 'kg (net)',
            self::DramUS          => 'dr (US)',
            self::DramUK          => 'dr (UK)',
            self::GrossKilogram   => 'kg (gross)',
            self::Grain           => 'gr',
            self::PoundNet        => 'lb (net)',
            self::Pennyweight     => 'dwt',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Kilogram        => 'kilogram',
            self::Kilotonne       => 'kilotonne',
            self::LongTon         => 'long ton',
            self::Megagram        => 'megagram',
            self::Tonne           => 'tonne',
            self::ShortTon        => 'short ton',
            self::Decitonne       => 'decitonne',
            self::Stone           => 'stone',
            self::Pound           => 'pound',
            self::Hectogram       => 'hectogram',
            self::Ounce           => 'ounce',
            self::Decagram        => 'decagram',
            self::TroyOunce       => 'troy ounce',
            self::Gram            => 'gram',
            self::Decigram        => 'decigram',
            self::Centigram       => 'centigram',
            self::Milligram       => 'milligram',
            self::Microgram       => 'microgram',
            self::Slug            => 'slug',
            self::HundredWeightUK => 'hundredweight (UK)',
            self::HundredWeightUS => 'hundredweight (US)',
            self::Pfund           => 'pfund',
            self::NetKilogram     => 'net kilogram',
            self::DramUS          => 'dram (US)',
            self::DramUK          => 'dram (UK)',
            self::GrossKilogram   => 'gross kilogram',
            self::Grain           => 'grain',
            self::PoundNet        => 'pound net',
            self::Pennyweight     => 'pennyweight',
        };
    }

    /**
     * @return list<string>
     */
    public function aliases(): array
    {
        return [$this->value, $this->symbol(), $this->label()];
    }

    public function multiplier(): string
    {
        return match ($this) {
            self::Kilogram        => '1',
            self::Kilotonne       => '1000000',
            self::LongTon         => '1016.047',
            self::Megagram        => '1000',
            self::Tonne           => '1000',
            self::ShortTon        => '907.1847',
            self::Decitonne       => '100',
            self::Stone           => '6.350293',
            self::Pound           => '0.45359237',
            self::Hectogram       => '0.1',
            self::Ounce           => '0.02834952',
            self::Decagram        => '0.01',
            self::TroyOunce       => '0.003110348',
            self::Gram            => '0.001',
            self::Decigram        => '0.0001',
            self::Centigram       => '0.00001',
            self::Milligram       => '0.000001',
            self::Microgram       => '0.000000001',
            self::Slug            => '14.5939',
            self::HundredWeightUK => '50.8023',
            self::HundredWeightUS => '45.3592',
            self::Pfund           => '0.5',
            self::NetKilogram     => '1',
            self::DramUS          => '0.003887935',
            self::DramUK          => '0.001771745',
            self::GrossKilogram   => '1',
            self::Grain           => '0.00006479891',
            self::PoundNet        => '0.45359237',
            self::Pennyweight     => '0.001555174',
        };
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Mass;
    }
}
