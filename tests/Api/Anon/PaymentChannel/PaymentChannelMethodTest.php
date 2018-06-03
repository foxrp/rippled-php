<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class PaymentChannelMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('channel_authorize_success'));

        $params = $this->getMinParams();
        $method = $this->client->method('channel_authorize', $params);

        $this->assertEquals('channel_authorize', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testMissingParamChannelIdThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['channel_id']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/channel_id/');
        $this->client->method('channel_authorize', $params);
    }

    public function testMissingParamSecretThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['secret']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/secret/');
        $this->client->method('channel_authorize', $params);
    }

    public function testMissingAmountThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['amount']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/amount/');
        $this->client->method('channel_authorize', $params);
    }

    /**
     * @return array Minimum parameters for this method.
     */
    public function getMinParams(): array
    {
        $params = [
            'channel_id' => '5DB01B7FFED6B67E6B0414DED11E051D2EE2B7619CE0EAA6286D67A3A4D5BDB3',
            'secret' => 's',
            'amount' => 1000000
        ];
        return $params;
    }
}
