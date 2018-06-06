<?php

namespace XRPHP\Tests\Api\Anon\Utility;

use XRPHP\Tests\Api\MethodTestCase;

class PingMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('generic_success'));

        $method = $this->client->method('ping');

        $this->assertEquals('ping', $method->getMethod());
        $this->assertSame(null, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }
}
