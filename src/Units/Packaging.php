<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Units;

use KolayBi\UnitConverter\Contracts\Unit;
use KolayBi\UnitConverter\Enums\UnitCategory;

enum Packaging: string implements Unit
{
    case Box = 'BX';
    case Packet = 'PA';
    case Pack = 'PK';
    case Bag = 'BG';
    case Roll = 'RO';
    case Drum = 'DR';
    case Ball = 'AA';
    case Reel = 'RL';
    case Barrel = 'BLL';
    case LinearMetre = 'LM';
    case Tube = 'TU';
    case Bottle = 'BO';
    case Tin = 'TN';
    case Sack = 'SA';
    case Person = 'IE';
    case BulkPack = 'AB';
    case Assortment = 'AS';
    case Assembly = 'AY';
    case Card = 'CG';
    case Deck = 'DK';
    case Book = 'D63';
    case Round = 'D65';
    case Hank = 'HA';
    case Head = 'HEA';
    case PipelineJoint = 'JNT';
    case Cake = 'KA';
    case Kit = 'KT';
    case Leaf = 'LEF';
    case Lot = 'LO';
    case Layer = 'LR';
    case LumpSum = 'LS';
    case Load = 'NL';
    case Panel = 'OA';
    case FivePack = 'P5';
    case Pad = 'PD';
    case Quire = 'QR';
    case Ream = 'RM';
    case Room = 'ROM';
    case Square = 'SQ';
    case Strip = 'SR';
    case Stick = 'STC';
    case StickCigarette = 'STK';
    case Straw = 'STW';
    case Skein = 'SW';
    case Shipment = 'SX';
    case Syringe = 'SYR';
    case Pellet = 'XPE';
    case HangingContainer = 'Z11';

    /** @deprecated Use standard Rec 20 codes instead. */
    case CarryingCapacityInMetricTonnes = 'CCT';

    /** @deprecated Use standard Rec 20 codes instead. */
    case GrossTonnage = 'GT';

    /** @deprecated Use standard Rec 20 codes instead. */
    case NumberOfCells = 'NCL';

    /** @deprecated Use standard Rec 20 codes instead. */
    case TankCylindrical = 'TK';

    public function code(): string
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return $this->value;
    }

    public function label(): string
    {
        return match ($this) {
            self::Box                            => 'box',
            self::Packet                         => 'packet',
            self::Pack                           => 'pack',
            self::Bag                            => 'bag',
            self::Roll                           => 'roll',
            self::Drum                           => 'drum',
            self::Ball                           => 'ball',
            self::Reel                           => 'reel',
            self::Barrel                         => 'barrel',
            self::LinearMetre                    => 'linear metre',
            self::Tube                           => 'tube',
            self::Bottle                         => 'bottle',
            self::Tin                            => 'tin',
            self::Sack                           => 'sack',
            self::Person                         => 'person',
            self::BulkPack                       => 'bulk pack',
            self::Assortment                     => 'assortment',
            self::Assembly                       => 'assembly',
            self::Card                           => 'card',
            self::Deck                           => 'deck',
            self::Book                           => 'book',
            self::Round                          => 'round',
            self::Hank                           => 'hank',
            self::Head                           => 'head',
            self::PipelineJoint                  => 'pipeline joint',
            self::Cake                           => 'cake',
            self::Kit                            => 'kit',
            self::Leaf                           => 'leaf',
            self::Lot                            => 'lot',
            self::Layer                          => 'layer',
            self::LumpSum                        => 'lump sum',
            self::Load                           => 'load',
            self::Panel                          => 'panel',
            self::FivePack                       => 'five pack',
            self::Pad                            => 'pad',
            self::Quire                          => 'quire',
            self::Ream                           => 'ream',
            self::Room                           => 'room',
            self::Square                         => 'square',
            self::Strip                          => 'strip',
            self::Stick                          => 'stick',
            self::StickCigarette                 => 'stick, cigarette',
            self::Straw                          => 'straw',
            self::Skein                          => 'skein',
            self::Shipment                       => 'shipment',
            self::Syringe                        => 'syringe',
            self::Pellet                         => 'pellet',
            self::HangingContainer               => 'hanging container',
            self::CarryingCapacityInMetricTonnes => 'carrying capacity in metric tonnes',
            self::GrossTonnage                   => 'gross tonnage',
            self::NumberOfCells                  => 'number of cells',
            self::TankCylindrical                => 'tank, cylindrical',
        };
    }

    /**
     * @return list<string>
     */
    public function aliases(): array
    {
        $base = [$this->value, $this->label()];

        return $base;
    }

    public function multiplier(): string
    {
        return '0';
    }

    public function offset(): string
    {
        return '0';
    }

    public function category(): UnitCategory
    {
        return UnitCategory::Packaging;
    }
}
