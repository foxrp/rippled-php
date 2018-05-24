<?php

namespace XRPHP\Api;

use XRPHP\Client;
use XRPHP\HttpClient\Message\ResponseMediator;

abstract class AbstractApi
{
    /** @var Client */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     *
     * @param string $method    Request path.
     * @param array  $params    POST parameters to be JSON encoded.
     *
     * @return array|string
     */
    protected function post(string $method, array $params = [])
    {
        $response = $this->client->post($method, $params);
        return ResponseMediator::getContent($response);
    }
}
