<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class ChannelVerifyMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('channel_verify_success'));

        $params = $this->getMinParams();
        $method = $this->client->method('channel_verify', $params);

        $this->assertEquals('channel_verify', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testMissingParamAmountThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['amount']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/amount/');
        $this->client->method('channel_verify', $params);
    }

    public function testMissingParamChannelIdThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['channel_id']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/channel_id/');
        $this->client->method('channel_verify', $params);
    }

    public function testMissingParamPublicKeyThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['public_key']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/public_key/');
        $this->client->method('channel_verify', $params);
    }

    public function testMissingSignatureThrowsException()
    {
        $params = $this->getMinParams();
        unset($params['signature']);
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/signature/');
        $this->client->method('channel_verify', $params);
    }

    /**
     * @return array Minimum parameters for this method.
     */
    public function getMinParams(): array
    {
        $params = [
            'amount' => 1000000,
            'channel_id' => '5DB01B7FFED6B67E6B0414DED11E051D2EE2B7619CE0EAA6286D67A3A4D5BDB3',
            'public_key' => 'aB44YfzW24VDEJQ2UuLPV2PvqcPCSoLnL7y5M1EzhdW4LnK5xMS3',
            'signature' => '5DB01B7FFED6B67E6B0414DED11E051D2EE2B7619CE0EAA6286D67A3A4D5BDB3'

        ];
        return $params;
    }
}
