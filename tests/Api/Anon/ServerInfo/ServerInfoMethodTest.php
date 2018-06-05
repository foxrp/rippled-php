<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Tests\Api\MethodTestCase;

class ServerInfoMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('server_info_success'));

        $method = $this->client->method('server_info');

        $this->assertEquals('server_info', $method->getMethod());
        $this->assertSame(null, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }
}
