<?php

namespace XRPHP\Tests\Transaction\Type;

use PHPUnit\Framework\TestCase;
use XRPHP\Api\Field;
use XRPHP\Transaction\TypeInterface;

class GeneratedTypeTest extends TestCase
{
    public function testFieldsInSyncWithSpec()
    {
        $spec = json_decode(file_get_contents(__DIR__ . '/../../../../rippled-spec/transactions.json'), true);
        foreach ($spec['types'] as $specType) {

            $typeClass = '\\XRPHP\\Api\\TransactionType\\' . $specType['name'];
            /** @var TypeInterface $type */
            $type = new $typeClass();
            $typeFields = $type->getFields();

            foreach ($specType['fields'] as $field) {
                /** @var Field $field */
                $this->assertTrue(isset($typeFields[$field['name']]));
                $this->assertEquals($field['required'], $typeFields[$field['name']]->isRequired());
            }
        }
    }
}
