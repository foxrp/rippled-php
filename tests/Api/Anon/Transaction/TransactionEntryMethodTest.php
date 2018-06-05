<?php

namespace XRPHP\Tests\Api\Anon\Transaction;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class TransactionEntryMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('transaction_entry_success'));

        $params = ['tx_hash' => 'test'];
        $method = $this->client->method('transaction_entry', $params);

        $this->assertEquals('transaction_entry', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testMissingTxBlobWithNullThrowsException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/tx_hash/');
        $this->client->method('transaction_entry', null);
    }
}
