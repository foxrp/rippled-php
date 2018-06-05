<?php

namespace XRPHP\Tests\Api\Anon\Transaction;

use XRPHP\Tests\Api\SignMethodTestCase;

class SignMethodTest extends SignMethodTestCase
{
    public function __construct()
    {
        $this->method = 'sign';
        parent::__construct();
    }

    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('sign_success'));

        $params = ['tx_json' => 'test'];
        $method = $this->client->method('sign', $params);

        $this->assertEquals('sign', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }
}
