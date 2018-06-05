<?php

namespace XRPHP\Tests\Api\Anon\Transaction;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class SubmitMultisignedMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('submit_multisigned_success'));

        $params = ['tx_json' => 'test'];
        $method = $this->client->method('submit_multisigned', $params);

        $this->assertEquals('submit_multisigned', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testMissingTxBlobWithNullThrowsException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/tx_json/');
        $this->client->method('submit_multisigned', null);
    }
}
