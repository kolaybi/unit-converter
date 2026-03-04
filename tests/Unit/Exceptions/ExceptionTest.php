<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit\Exceptions;

use InvalidArgumentException;
use KolayBi\UnitConverter\Exceptions\IncompatibleUnitsException;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;
use KolayBi\UnitConverter\Exceptions\UnitNotFoundException;
use LogicException;
use PHPUnit\Framework\TestCase;

final class ExceptionTest extends TestCase
{
    public function testUnitNotFoundException(): void
    {
        $exception = new UnitNotFoundException('xyz');

        $this->assertInstanceOf(InvalidArgumentException::class, $exception);
        $this->assertStringContainsString('xyz', $exception->getMessage());
    }

    public function testIncompatibleUnitsException(): void
    {
        $exception = new IncompatibleUnitsException('mass', 'length');

        $this->assertInstanceOf(LogicException::class, $exception);
        $this->assertStringContainsString('mass', $exception->getMessage());
        $this->assertStringContainsString('length', $exception->getMessage());
    }

    public function testNonConvertibleUnitException(): void
    {
        $exception = new NonConvertibleUnitException('BX');

        $this->assertInstanceOf(LogicException::class, $exception);
        $this->assertStringContainsString('BX', $exception->getMessage());
    }
}
