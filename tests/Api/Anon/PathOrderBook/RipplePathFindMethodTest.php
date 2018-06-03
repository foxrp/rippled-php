<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class RipplePathFindMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('ripple_path_find_success'));

        $params = $this->getMinParams();
        $method = $this->client->method('ripple_path_find', $params);

        $this->assertEquals('ripple_path_find', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testMissingParamSourceAccountThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['source_account']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/source_account/');
        $this->client->method('ripple_path_find', $params);
    }

    public function testMissingParamDestAccountThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['destination_account']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/destination_account/');
        $this->client->method('ripple_path_find', $params);
    }

    public function testMissingParamDestAmountThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['destination_amount']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/destination_amount/');
        $this->client->method('ripple_path_find', $params);
    }

    /**
     * @return array Minimum parameters for this method.
     */
    public function getMinParams(): array
    {
        $params = [
            'source_account' => 'r9cZA1mLK5R5Am25ArfXFmqgNwjZgnfk59',
            'source_currencies' => [
                ['currency' => 'XRP'],
                ['currency' => 'USD']
            ],
            'destination_account' => 'r9cZA1mLK5R5Am25ArfXFmqgNwjZgnfk59',
            'destination_amount' => [
                'value' => '0001',
                'currency' => 'USD',
                'issuer' => ''
            ]
        ];
        return $params;
    }
}
