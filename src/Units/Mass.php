<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Mass: string implements Unit
{
    case Kilogram                       = 'KGM';
    case Kilotonne                      = 'KTN';
    case TonUKOrLongTonUS               = 'LTN';
    case Megagram                       = '2U';
    case TonneMetricTon                 = 'TNE';
    case TonUSOrShortTonUKUS            = 'STN';
    case Decitonne                      = 'DTN';
    case StoneUK                        = 'STI';
    case Pound                          = 'LBR';
    case Hectogram                      = 'HGM';
    case Ounce                          = 'ONZ';
    case Decagram                       = 'DJ';
    case TroyOunceOrApothecaryOunce     = 'APZ';
    case Gram                           = 'GRM';
    case Decigram                       = 'DG';
    case Centigram                      = 'CGM';
    case Milligram                      = 'MGM';
    case Microgram                      = 'MC';
    case Slug                           = 'F13';
    case HundredWeightUK                = 'CWI';
    case HundredPoundCwtHundredWeightUS = 'CWA';
    case Pfund                          = 'M86';
    case NetKilogram                    = '58';
    case DramUS                         = 'DRA';
    case DramUK                         = 'DRI';
    case GrossKilogram                  = 'E4';
    case Grain                          = 'GRN';
    case PoundNet                       = 'PN';
    case Pennyweight                    = 'DWT';

    public function symbol(): string
    {
        return match ($this) {
            self::Kilogram                       => 'kg',
            self::Kilotonne                      => 'kt',
            self::TonUKOrLongTonUS               => 'ton (UK)',
            self::Megagram                       => 'Mg',
            self::TonneMetricTon                 => 't',
            self::TonUSOrShortTonUKUS            => 'ton (US)',
            self::Decitonne                      => 'dt',
            self::StoneUK                        => 'st',
            self::Pound                          => 'lb',
            self::Hectogram                      => 'hg',
            self::Ounce                          => 'oz',
            self::Decagram                       => 'dag',
            self::TroyOunceOrApothecaryOunce     => 'tr oz',
            self::Gram                           => 'g',
            self::Decigram                       => 'dg',
            self::Centigram                      => 'cg',
            self::Milligram                      => 'mg',
            self::Microgram                      => 'µg',
            self::Slug                           => 'slug',
            self::HundredWeightUK                => 'cwt (UK)',
            self::HundredPoundCwtHundredWeightUS => 'cwt (US)',
            self::Pfund                          => 'pfd',
            self::NetKilogram                    => '58',
            self::DramUS                         => 'DRA',
            self::DramUK                         => 'DRI',
            self::GrossKilogram                  => 'E4',
            self::Grain                          => 'gr',
            self::PoundNet                       => 'PN',
            self::Pennyweight                    => 'dwt',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Kilogram                       => 'kilogram',
            self::Kilotonne                      => 'kilotonne',
            self::TonUKOrLongTonUS               => 'ton (UK) or long ton (US)',
            self::Megagram                       => 'megagram',
            self::TonneMetricTon                 => 'tonne (metric ton)',
            self::TonUSOrShortTonUKUS            => 'ton (US) or short ton (UK/US)',
            self::Decitonne                      => 'decitonne',
            self::StoneUK                        => 'stone (UK)',
            self::Pound                          => 'pound',
            self::Hectogram                      => 'hectogram',
            self::Ounce                          => 'ounce',
            self::Decagram                       => 'decagram',
            self::TroyOunceOrApothecaryOunce     => 'troy ounce or apothecary ounce',
            self::Gram                           => 'gram',
            self::Decigram                       => 'decigram',
            self::Centigram                      => 'centigram',
            self::Milligram                      => 'milligram',
            self::Microgram                      => 'microgram',
            self::Slug                           => 'slug',
            self::HundredWeightUK                => 'hundred weight (UK)',
            self::HundredPoundCwtHundredWeightUS => 'hundred pound (cwt) / hundred weight (US)',
            self::Pfund                          => 'pfund',
            self::NetKilogram                    => 'net kilogram',
            self::DramUS                         => 'dram (US)',
            self::DramUK                         => 'dram (UK)',
            self::GrossKilogram                  => 'gross kilogram',
            self::Grain                          => 'grain',
            self::PoundNet                       => 'pound net',
            self::Pennyweight                    => 'pennyweight',
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
            self::Kilogram                       => '1',
            self::Kilotonne                      => '1000000',
            self::TonUKOrLongTonUS               => '1016.047',
            self::Megagram                       => '1000',
            self::TonneMetricTon                 => '1000',
            self::TonUSOrShortTonUKUS            => '907.1847',
            self::Decitonne                      => '100',
            self::StoneUK                        => '6.350293',
            self::Pound                          => '0.45359237',
            self::Hectogram                      => '0.1',
            self::Ounce                          => '0.02834952',
            self::Decagram                       => '0.01',
            self::TroyOunceOrApothecaryOunce     => '0.003110348',
            self::Gram                           => '0.001',
            self::Decigram                       => '0.0001',
            self::Centigram                      => '0.00001',
            self::Milligram                      => '0.000001',
            self::Microgram                      => '0.000000001',
            self::Slug                           => '14.5939',
            self::HundredWeightUK                => '50.8023',
            self::HundredPoundCwtHundredWeightUS => '45.3592',
            self::Pfund                          => '0.5',
            self::NetKilogram                    => '1',
            self::DramUS                         => '0.003887935',
            self::DramUK                         => '0.001771745',
            self::GrossKilogram                  => '1',
            self::Grain                          => '0.00006479891',
            self::PoundNet                       => '0.45359237',
            self::Pennyweight                    => '0.001555174',
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
