<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Tests\Api\MethodTestCase;

class LedgerCurrentMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('ledger_current_success'));

        $params = [];
        $method = $this->client->method('ledger_current', $params);

        $this->assertEquals('ledger_current', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testInvalidParamsThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('ledger_current', [
            'not_a_param' => 'should cause an exception'
        ]);
    }
}
