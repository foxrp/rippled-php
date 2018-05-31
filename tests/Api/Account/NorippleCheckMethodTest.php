<?php

namespace XRPHP\Tests\Api\Account;

use XRPHP\Tests\Api\MethodTestCase;

class NorippleCheckMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('noripple_check_success'));

        $params = ['account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn'];
        $method = $this->client->method('noripple_check', $params);

        $this->assertEquals('noripple_check', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
        $this->assertFalse($res->isValidated(), 'isValidated is not null');
    }

    public function testMissingAccountWithEmptyArrayThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('noripple_check', []);
    }

    public function testMissingAccountWithNullThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('noripple_check', null);
    }

    public function testInvalidParamsThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('noripple_check', [
            'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn',
            'not_a_param' => 'should cause an exception'
        ]);
    }
}
