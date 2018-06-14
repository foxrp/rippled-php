<?php

namespace XRPHP\Tests\Exception;

use PHPUnit\Framework\TestCase;
use XRPHP\Exception\TransactionTypeFieldException;

class TransactionTypeFieldExceptionTest extends TestCase
{
    public function testConstructor(): void
    {
        $obj = new TransactionTypeFieldException('Foo', 1);
        $this->assertEquals('Foo', $obj->getMessage());
    }
}
