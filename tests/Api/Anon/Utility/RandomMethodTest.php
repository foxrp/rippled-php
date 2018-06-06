<?php

namespace XRPHP\Tests\Api\Anon\Utility;

use XRPHP\Tests\Api\MethodTestCase;

class RandomMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('generic_success'));

        $method = $this->client->method('random');

        $this->assertEquals('random', $method->getMethod());
        $this->assertSame(null, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }
}
