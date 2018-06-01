<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class AccountChannelsMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('account_channels_success'));

        $params = ['account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'];
        $method = $this->client->method('account_channels', $params);

        $this->assertEquals('account_channels', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
        $this->assertTrue($res->isValidated(), 'isValidated is not null');
    }

    public function testMissingAccountWithEmptyArrayThrowsException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->client->method('account_channels', []);
    }

    public function testMissingAccountWithNullThrowsException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->client->method('account_channels', null);
    }

    public function testInvalidParamsThrowsException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->client->method('account_channels', [
            'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn',
            'not_a_param' => 'should cause an exception'
        ]);
    }
}
