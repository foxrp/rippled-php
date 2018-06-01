<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class LedgerEntryMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('ledger_entry_success'));

        $params = [];
        $method = $this->client->method('ledger_entry', $params);

        $this->assertEquals('ledger_entry', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

//    public function testInvalidParamsThrowsException()
//    {
//        $this->expectException(InvalidParameterException::class);
//        $this->client->method('ledger_entry', [
//            'not_a_param' => 'should cause an exception'
//        ]);
//    }
}
