<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class BookOffersMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('book_offers_success'));

        $params = $this->getMinParams();
        $method = $this->client->method('book_offers', $params);

        $this->assertEquals('book_offers', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testMissingParamsTakerGetsThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['taker_gets']);
        $this->expectException(InvalidParameterException::class);
        $this->client->method('book_offers', $params);
    }

    public function testMissingParamsTakerPaysThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['taker_pays']);
        $this->expectException(InvalidParameterException::class);
        $this->client->method('book_offers', $params);
    }

    /**
     * @return array Minimum parameters for this method.
     */
    public function getMinParams(): array
    {
        $params = [
            'taker_gets' => [
                'currency' => 'XRP'
            ],
            'taker_pays' => [
                'currency' => 'USD',
                'issuer' => 'rvYAfWj5gh67oV6fW32ZzP3Aw4Eubs59B'
            ]
        ];
        return $params;
    }
}
