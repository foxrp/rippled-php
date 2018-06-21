<?php

namespace XRPHP\FunctionalTests;

use PHPUnit\Framework\TestCase;
use XRPHP\Client;

class FunctionalTestCase extends TestCase
{
    /** @var string */
    protected $endpoint;

    /** @var string */
    protected $acct1Id;

    /** @var string */
    protected $acct1Secret;

    /** @var string */
    protected $acc2Id;

    /** @var string */
    protected $acc2Secret;

    /** @var Client */
    protected $client;

    public function setup()
    {
        $this->endpoint = getenv('FOXRP_RIPPLED_ENDPOINT');
        $this->acct1Id = getenv('FOXRP_ACCT_1_ID');
        $this->acct1Secret = getenv('FOXRP_ACCT_1_SECRET');
        $this->acc2Id = getenv('FOXRP_ACCT_2_ID');
        $this->acc2Secret = getenv('FOXRP_ACCT_2_SECRET');
        $this->client = new Client($this->endpoint);
    }
}
