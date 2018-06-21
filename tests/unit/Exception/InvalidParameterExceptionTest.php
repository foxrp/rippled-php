<?php

namespace XRPHP\Tests\Exception;

use PHPUnit\Framework\TestCase;
use XRPHP\Exception\InvalidParameterException;

class InvalidParameterExceptionTest extends TestCase
{
    public function testConstructor(): void
    {
        $obj = new InvalidParameterException('Foo', 1);
        $this->assertEquals('Foo', $obj->getMessage());
    }
}
