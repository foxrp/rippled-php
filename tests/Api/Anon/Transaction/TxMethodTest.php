<?php

namespace XRPHP\Tests\Api\Anon\Transaction;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class TxMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('generic_success'));

        $params = ['transaction' => 'test'];
        $method = $this->client->method('tx', $params);

        $this->assertEquals('tx', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testMissingTxBlobWithNullThrowsException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/transaction/');
        $this->client->method('tx', null);
    }
}
