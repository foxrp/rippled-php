<?php

namespace XRPHP\Tests\Api\Anon\Transaction;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class SubmitMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('submit_success'));

        $params = ['tx_blob' => 'test'];
        $method = $this->client->method('submit', $params);

        $this->assertEquals('submit', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testMissingTxBlobWithNullThrowsException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/tx_blob/');
        $this->client->method('submit', null);
    }
}
