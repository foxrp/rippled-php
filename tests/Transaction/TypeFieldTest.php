<?php

namespace XRPHP\Tests\Transaction;

use PHPUnit\Framework\TestCase;
use XRPHP\Exception\TransactionTypeFieldException;
use XRPHP\Transaction\TypeField;

/**
*  Test for Client class
*/
class TypeFieldTest extends TestCase
{
    /**
    * Check for syntax errors
    */
    public function testIsThereAnySyntaxError(): void
    {
        $field = new TypeField(['name' => 'Foo']);
        $this->assertInternalType('object', $field);
    }

    /**
     * Check that no Client is created when no args are passed in.
     */
    public function testMissingNameInConstructorThrowsException(): void
    {
        $this->expectException(TransactionTypeFieldException::class);
        $this->expectExceptionMessageRegExp('/name/');

        $field = new TypeField([]);
    }

    public function testPropsSetInConstructor()
    {
        $field = new TypeField(
            [
                'name' => 'a',
                'description' => 'b',
                'jsonType' => 'c',
                'required' => true,
                'autoFillable' => true
            ]
        );

        $this->assertEquals('a', $field->getName());
        $this->assertEquals('b', $field->getDescription());
        $this->assertEquals('c', $field->getJsonType());
        $this->assertTrue($field->isRequired());
        $this->assertTrue($field->isAutoFillable());
    }
}
