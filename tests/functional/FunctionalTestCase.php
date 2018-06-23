<?php

namespace FOXRP\Rippled\FunctionalTests;

use PHPUnit\Framework\TestCase;
use FOXRP\Rippled\Client;

class FunctionalTestCase extends TestCase
{
    /** @var string */
    protected $endpoint;

    /** @var string */
    protected $acct1Id;

    /** @var string */
    protected $acct1Secret;

    /** @var string */
    protected $acct2Id;

    /** @var string */
    protected $acct2Secret;

    /** @var Client */
    protected $client;

    public function setup()
    {
        $this->endpoint = getenv('FOXRP_RIPPLED_ENDPOINT');
        $this->acct1Id = getenv('FOXRP_ACCT_1_ID');
        $this->acct1Secret = getenv('FOXRP_ACCT_1_SECRET');
        $this->acct2Id = getenv('FOXRP_ACCT_2_ID');
        $this->acct2Secret = getenv('FOXRP_ACCT_2_SECRET');
        $this->client = new Client($this->endpoint);
    }

    /**
     * @param string $account
     * @return mixed
     * @throws \Exception
     */
    public function getBalance(string $account)
    {
        $res = $this->client->send('account_info', [
            'account' => $account
        ]);
        $data = $res->getResult();
        return $data['account_data']['Balance'];
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getAcct1Id(): string
    {
        return $this->acct1Id;
    }

    /**
     * @param string $acct1Id
     */
    public function setAcct1Id(string $acct1Id): void
    {
        $this->acct1Id = $acct1Id;
    }

    /**
     * @return string
     */
    public function getAcct1Secret(): string
    {
        return $this->acct1Secret;
    }

    /**
     * @param string $acct1Secret
     */
    public function setAcct1Secret(string $acct1Secret): void
    {
        $this->acct1Secret = $acct1Secret;
    }

    /**
     * @return string
     */
    public function getAcct2Id(): string
    {
        return $this->acct2Id;
    }

    /**
     * @param string $acct2Id
     */
    public function setAcct2Id(string $acct2Id): void
    {
        $this->acct2Id = $acct2Id;
    }

    /**
     * @return string
     */
    public function getAcct2Secret(): string
    {
        return $this->acct2Secret;
    }

    /**
     * @param string $acct2Secret
     */
    public function setAcct2Secret(string $acct2Secret): void
    {
        $this->acct2Secret = $acct2Secret;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
}
