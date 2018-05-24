<?php

namespace XRPhp\Tests\Api;

use PHPUnit\Framework\TestCase;
use XRPHP\Client;

class AccountTest extends TestCase
{
    /** @var Client */
    private $client;

    public function setUp()
    {
        $this->client = new \XRPHP\Client('https://s1.ripple.com:51234');
    }

    public function testAccountChannels(): void
    {
        $data = $this->client->account()->channels('rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn');

        $this->assertTrue(is_array($data));
    }

    public function testAccountCurrencies(): void
    {
        $data = $this->client->account()->currencies('rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn');

        $this->assertTrue(is_array($data));
    }

    public function testAccountInfo(): void
    {
        $data = $this->client->account()->info('rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn');

        $this->assertTrue(is_array($data));
    }

    public function testAccountLines(): void
    {
        $data = $this->client->account()->lines('rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn');

        $this->assertTrue(is_array($data));
    }

    public function testAccountObjects(): void
    {
        $data = $this->client->account()->objects('rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn');

        $this->assertTrue(is_array($data));
    }

    public function testAccountOffers(): void
    {
        $data = $this->client->account()->offers('rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn');

        $this->assertTrue(is_array($data));
    }

    public function testAccountTx(): void
    {
        $data = $this->client->account()->tx('rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn');

        $this->assertTrue(is_array($data));
    }

    public function testAccountGatewayBalances(): void
    {
        $data = $this->client->account()->gatewayBalances('rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn');

        $this->assertTrue(is_array($data));
    }

    public function testAccountNorippleCheck(): void
    {
        $data = $this->client->account()->norippleCheck('rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn');

        $this->assertTrue(is_array($data));
    }
}
