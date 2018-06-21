<?php

namespace XRPHP\Tests\Api\Method;

use PHPUnit\Framework\TestCase;
use XRPHP\Api\Field;
use XRPHP\Api\MethodInterface;
use XRPHP\Transaction\TypeInterface;
use XRPHP\Util;

class GeneratedMethodTest extends TestCase
{
    public function testFieldsInSyncWithSpec()
    {
        $spec = json_decode(file_get_contents(__DIR__ . '/../../../rippled-spec/api.json'), true);
        foreach ($spec['methods'] as $item) {

            $typeClass = '\\XRPHP\\Api\\Method\\' . Util::CaseFromSnake($item['name']);
            /** @var MethodInterface $method */
            $method = new $typeClass();
            $methodFields = $method->getFields();

            foreach ($item['fields'] as $field) {
                /** @var Field $field */
                $this->assertTrue(isset($methodFields[$field['name']]));
                $this->assertEquals($field['required'], $methodFields[$field['name']]->isRequired());
            }
        }
    }
}
