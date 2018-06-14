<?php

namespace XRPHP\Tests\Transaction;

use PHPUnit\Framework\TestCase;
use XRPHP\Exception\TransactionTypeException;
use XRPHP\Transaction\Type\Payment;
use XRPHP\Transaction\TypeMap;

/**
*  Test for Client class
*/
class TypeMapTest extends TestCase
{
    /**
    * Check that we can find the Payment class.
    */
    public function testFindClassSuccess(): void
    {
        $class = TypeMap::FindClass('Payment');
        $this->assertEquals(Payment::class, $class);
    }

    /**
     * Check exception is thrown for invalid type.
     */
    public function testInvalidTypeThrowsException()
    {
        $this->expectException(TransactionTypeException::class);
        $this->expectExceptionMessageRegExp('/Foo/');

        $class = TypeMap::FindClass('Foo');
    }
}
