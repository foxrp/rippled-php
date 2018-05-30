<?php

namespace XRPHP\Tests\Api\Account;

use XRPHP\Tests\Api\MethodTestCase;

class AccountLinesMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('account_lines_success'));

        $params = ['account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'];
        $method = $this->client->method('account_lines', $params);

        $this->assertEquals('account_lines', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
        $this->assertNull($res->isValidated(), 'isValidated is not null');
    }

    public function testMissingAccountWithEmptyArrayThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('account_lines', []);
    }

    public function testMissingAccountWithNullThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('account_lines', null);
    }

    public function testInvalidParamsThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('account_lines', [
            'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn',
            'not_a_param' => 'should cause an exception'
        ]);
    }
}
