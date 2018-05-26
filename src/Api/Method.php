<?php

namespace XRPHP\Api;

use XRPHP\Client;

abstract class Method
{
    /** @var Client */
    private $client;

    /** @var string */
    private $method;

    /** @var array */
    private $params;

    public function __construct(Client $client, string $method, array $params = null)
    {
        $this->client = $client;
        $this->method = $method;
        $this->params = $params;

        // Check that only valid parameters have been passed in
        $validParams = $this->getValidParameters();
        if ($validParams !== null) {
            if ($params !== null) {
                $diff = array_diff(array_keys($params), $validParams);

                if (\count($diff) > 0) {
                    throw new \BadMethodCallException(sprintf('Unknown parameters: %s', implode(', ', $diff)));
                }
            }

            // Validate parameters
            $this->validateParameters($this->params);

        } elseif ($params !== null) {
            throw new \BadMethodCallException('Unknown parameters: %s', implode(array_keys($this->params)));
        }
    }

    /**
     * Override this method is extending class.
     *
     * @return array Valid parameter keys
     */
    public function getValidParameters(): ?array
    {
        return null;
    }

    /**
     * Executes the API call.
     *
     * @return MethodResponse
     * @throws \Exception
     */
    public function execute(): MethodResponse
    {
        return new MethodResponse($this->client->post($this->method, $this->params));
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

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method): void
    {
        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }
}
