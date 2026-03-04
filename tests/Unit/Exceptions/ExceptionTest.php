<?php

declare(strict_types=1);

namespace KolayBi\UnitConverter\Tests\Unit\Exceptions;

use KolayBi\UnitConverter\Exceptions\IncompatibleUnitsException;
use KolayBi\UnitConverter\Exceptions\NonConvertibleUnitException;
use KolayBi\UnitConverter\Exceptions\UnitNotFoundException;
use PHPUnit\Framework\TestCase;

final class ExceptionTest extends TestCase
{
    public function test_unit_not_found_exception(): void
    {
        $exception = new UnitNotFoundException('xyz');

        $this->assertInstanceOf(\InvalidArgumentException::class, $exception);
        $this->assertStringContainsString('xyz', $exception->getMessage());
    }

    public function test_incompatible_units_exception(): void
    {
        $exception = new IncompatibleUnitsException('mass', 'length');

        $this->assertInstanceOf(\LogicException::class, $exception);
        $this->assertStringContainsString('mass', $exception->getMessage());
        $this->assertStringContainsString('length', $exception->getMessage());
    }

    public function test_non_convertible_unit_exception(): void
    {
        $exception = new NonConvertibleUnitException('BX');

        $this->assertInstanceOf(\LogicException::class, $exception);
        $this->assertStringContainsString('BX', $exception->getMessage());
    }
}
