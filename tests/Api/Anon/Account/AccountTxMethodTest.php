<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Tests\Api\MethodTestCase;

class AccountTxMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('account_tx_success'));

        $params = ['account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn', 'ledger_index' => 'current'];
        $method = $this->client->method('account_tx', $params);

        $this->assertEquals('account_tx', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
        $this->assertTrue($res->isValidated(), 'isValidated is not null');
    }

    public function testMissingAccountWithEmptyArrayThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('account_tx', []);
    }

    public function testMissingAccountWithNullThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('account_tx', null);
    }

    public function testInvalidParamsThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('account_tx', [
            'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn',
            'ledger_index' => 'current',
            'not_a_param' => 'should cause an exception'
        ]);
    }

    public function testMissingLedgerParamThrowsException()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->method('account_tx', [
            'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn',
        ]);
    }
}
