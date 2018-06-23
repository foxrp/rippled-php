<?php

namespace FOXRP\Rippled\Tests\Exception;

use PHPUnit\Framework\TestCase;
use FOXRP\Rippled\Exception\InvalidParameterException;

class InvalidParameterExceptionTest extends TestCase
{
    public function testConstructor(): void
    {
        $obj = new InvalidParameterException('Foo', 1);
        $this->assertEquals('Foo', $obj->getMessage());
    }
}
