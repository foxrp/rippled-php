<?php

namespace XRPHP\Tests\Api;

use PHPUnit\Framework\TestCase;
use XRPHP\Exception\FieldException;
use XRPHP\Api\Field;

/**
*  Test for Client class
*/
class FieldTest extends TestCase
{
    /**
    * Check for syntax errors
    */
    public function testIsThereAnySyntaxError(): void
    {
        $field = new Field(['name' => 'Foo']);
        $this->assertInternalType('object', $field);
    }

    /**
     * Check that no Client is created when no args are passed in.
     */
    public function testMissingNameInConstructorThrowsException(): void
    {
        $this->expectException(FieldException::class);
        $this->expectExceptionMessageRegExp('/name/');

        $field = new Field([]);
    }

    public function testPropsSetInConstructor()
    {
        $field = new Field(
            [
                'name' => 'a',
                'description' => 'b',
                'jsonType' => 'c',
                'required' => true
            ]
        );

        $this->assertEquals('a', $field->getName());
        $this->assertEquals('b', $field->getDescription());
        $this->assertEquals('c', $field->getJsonType());
        $this->assertTrue($field->isRequired());
    }
}
