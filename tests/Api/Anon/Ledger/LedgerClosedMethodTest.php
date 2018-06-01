<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Tests\Api\MethodTestCase;

class LedgerClosedMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('ledger_closed_success'));

        $params = [];
        $method = $this->client->method('ledger_closed', $params);

        $this->assertEquals('ledger_closed', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testInvalidParamsThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('ledger_closed', [
            'not_a_param' => 'should cause an exception'
        ]);
    }
}
