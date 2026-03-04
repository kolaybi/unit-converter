<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit;

use KolayBi\UnitConverter\Converter;
use KolayBi\UnitConverter\UnitResolver;
use KolayBi\UnitConverter\Units\FlowRate;
use PHPUnit\Framework\TestCase;

final class NewFlowRateUnitsTest extends TestCase
{
    protected function setUp(): void
    {
        UnitResolver::reset();
    }

    public function testNewFlowRateUnitsResolve(): void
    {
        $this->assertSame(FlowRate::LitrePerSecond, Converter::unit('l/s'));
        $this->assertSame(FlowRate::CentilitrePerSecond, Converter::unit('cl/s'));
        $this->assertSame(FlowRate::DecilitrePerSecond, Converter::unit('dl/s'));
        $this->assertSame(FlowRate::CubicInchPerHour, Converter::unit('in³/h'));
        $this->assertSame(FlowRate::CubicMillimetrePerSecond, Converter::unit('mm³/s'));
    }

    public function testLitrePerSecondConversion(): void
    {
        // 1 l/s = 1000 ml/s
        $result = Converter::convert(1)->from(FlowRate::LitrePerSecond)->to(FlowRate::MillilitrePerSecond);
        $this->assertEqualsWithDelta(1000, $result->toFloat(), 0.1);
    }

    public function testCubicMillimetrePerSecondConversion(): void
    {
        // 1,000,000 mm³/s = 1 l/s
        $result = Converter::convert(1000000)->from(FlowRate::CubicMillimetrePerSecond)->to(FlowRate::LitrePerSecond);
        $this->assertEqualsWithDelta(1, $result->toFloat(), 0.01);
    }
}
