<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Tests\Api\MethodTestCase;

class LedgerMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('ledger_success'));

        $params = [];
        $method = $this->client->method('ledger', $params);

        $this->assertEquals('ledger', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
        $this->assertTrue($res->isValidated(), 'isValidated is not null');
    }

    public function testInvalidParamsThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('ledger', [
            'not_a_param' => 'should cause an exception'
        ]);
    }
}
