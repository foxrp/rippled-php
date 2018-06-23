<?php

namespace FOXRP\Rippled\Tests\Exception;

use PHPUnit\Framework\TestCase;
use FOXRP\Rippled\Exception\TransactionSignException;

class TransactionSignExceptionTest extends TestCase
{
    public function testConstructor(): void
    {
        $obj = new TransactionSignException('Foo', 1);
        $this->assertEquals('Foo', $obj->getMessage());
    }
}
