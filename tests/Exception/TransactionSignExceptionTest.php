<?php

namespace XRPHP\Tests\Exception;

use PHPUnit\Framework\TestCase;
use XRPHP\Exception\TransactionSignException;

class TransactionSignExceptionTest extends TestCase
{
    public function testConstructor(): void
    {
        $obj = new TransactionSignException('Foo', 1);
        $this->assertEquals('Foo', $obj->getMessage());
    }
}
