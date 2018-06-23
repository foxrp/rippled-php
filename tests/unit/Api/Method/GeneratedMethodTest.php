<?php

namespace FOXRP\Rippled\Tests\Api\Method;

use PHPUnit\Framework\TestCase;
use FOXRP\Rippled\Api\Field;
use FOXRP\Rippled\Api\MethodInterface;
use FOXRP\Rippled\Transaction\TypeInterface;
use FOXRP\Rippled\Util;

class GeneratedMethodTest extends TestCase
{
    public function testFieldsInSyncWithSpec()
    {
        $spec = json_decode(file_get_contents(__DIR__ . '/../../../../rippled-spec/api.json'), true);
        foreach ($spec['methods'] as $item) {

            $typeClass = '\\FOXRP\Rippled\\Api\\Method\\' . Util::CaseFromSnake($item['name']);
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
