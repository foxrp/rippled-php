<?php

namespace XRPHP\Tests\Api\Anon\Transaction;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\SignMethodTestCase;

class SignForMethodTest extends SignMethodTestCase
{
    public function __construct()
    {
        $this->method = 'sign_for';
        parent::__construct();
    }

    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('sign_for_success'));

        $params = ['account' => 'r12345', 'tx_json' => 'test'];
        $method = $this->client->method('sign_for', $params);

        $this->assertEquals('sign_for', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testMissingAccountWithNullThrowsException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->client->method('sign_for', ['tx_json' => 'test']);
    }
}
