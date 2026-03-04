<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\UnitResolver;
use KolayBi\UnitConverter\Units\Energy;
use KolayBi\UnitConverter\Units\FlowRate;
use KolayBi\UnitConverter\Units\Length;
use KolayBi\UnitConverter\Units\Mass;
use KolayBi\UnitConverter\Units\MemoryCapacity;
use KolayBi\UnitConverter\Units\Time;
use KolayBi\UnitConverter\Units\Volume;
use PHPUnit\Framework\TestCase;

final class OfisApiAliasesTest extends TestCase
{
    protected function setUp(): void
    {
        UnitResolver::reset();
    }

    public function testOfisApiAliasesResolve(): void
    {
        $aliases = [
            'B'      => MemoryCapacity::Byte,
            'MB'     => MemoryCapacity::Megabyte,
            'TB'     => MemoryCapacity::Terabyte,
            'lt'     => Volume::Litre,
            'pnt'    => Volume::PintUS,
            'ftlb'   => Energy::FootPoundForce,
            'mu'     => Length::Micrometre,
            'lt/h'   => FlowRate::LitrePerHour,
            'lt/min' => FlowRate::LitrePerMinute,
            '26'     => Mass::TonneMetricTon,
            'KTM'    => Length::Kilometre,
            'AYR'    => Time::Year,
            'LPA'    => Volume::Litre,
        ];

        foreach ($aliases as $alias => $expected) {
            $alias = (string) $alias;
            $this->assertSame($expected, Converter::unit($alias), "Alias '{$alias}' should resolve");
        }
    }
}
