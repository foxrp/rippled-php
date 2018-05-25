<?php

namespace XRPHP\Tests\Api;

class AccountTest extends ApiTestCase
{
    public function __construct()
    {
        $this->testClass = \XRPHP\Api\Account::class;
        parent::__construct();
    }

    public function testAccountChannels(): void
    {
        $this->runMethodTest('channels');
    }

    public function testAccountCurrencies(): void
    {
        $this->runMethodTest('currencies');
    }

    public function testAccountInfo(): void
    {
        $this->runMethodTest('info');
    }

    public function testAccountLines(): void
    {
        $this->runMethodTest('lines');
    }

    public function testAccountObjects(): void
    {
        $this->runMethodTest('objects');
    }

    public function testAccountOffers(): void
    {
        $this->runMethodTest('offers');
    }

    public function testAccountTx(): void
    {
        $this->runMethodTest('tx');
    }

    public function testAccountGatewayBalances(): void
    {
        $this->runMethodTest('gatewayBalances');
    }

    public function testAccountNorippleCheck(): void
    {
        $this->runMethodTest('norippleCheck');
    }
}
