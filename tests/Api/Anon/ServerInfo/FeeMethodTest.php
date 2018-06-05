<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Tests\Api\MethodTestCase;

class FeeMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('fee_success'));

        $method = $this->client->method('fee');

        $this->assertEquals('fee', $method->getMethod());
        $this->assertSame(null, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }
}
