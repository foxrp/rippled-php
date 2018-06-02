<?php

namespace XRPHP\Api;

use XRPHP\Client;
use XRPHP\Exception\InvalidParameterException;

abstract class Method
{
    /** @var Client */
    private $client;

    /** @var string */
    private $method;

    /** @var array */
    private $params;

    /**
     * Method constructor.
     *
     * @param Client $client XRPHP Client.
     * @param string $method API method.
     * @param array|null $params Associative array of method parameters.
     * @throws InvalidParameterException
     */
    public function __construct(Client $client, string $method, array $params = null)
    {
        $this->setClient($client);
        $this->setMethod($method);
        $this->setParams($params);

        // Check that only valid parameters have been passed in
        $validParams = $this->getValidParameters();
        if ($validParams !== null) {
            if ($params !== null) {
                $diff = array_diff(array_keys($params), $validParams);

                if (\count($diff) > 0) {
                    throw new InvalidParameterException(sprintf('Unknown parameters: %s', implode(', ', $diff)));
                }
            }
        }

        // Validate parameters.
        $this->validateParameters($this->getParams());
    }

    /**
     * Returns an array of supported parameters. Used by
     * an override method in the extending class.
     *
     * @return array Valid parameter keys
     */
    public function getValidParameters(): ?array
    {
        return null;
    }

    /**
     * Validates parameters and throws exception. Used by
     * an override method in the extending class.
     *
     * @param array|null $params
     */
    public function validateParameters(array $params = null): void
    {
    }

    /**
     * Validates common parameters used among transaction signing methods.
     *
     * @param array $params
     * @throws InvalidParameterException
     */
    public function validateSignParameters(array $params): void
    {
        if (!isset($params['tx_json'])) {
            throw new InvalidParameterException('Missing parameter: tx_json');
        }

        if (isset($params['secret'])) {
            if (isset(
                $params['key_type'],
                $params['seed'],
                $params['seed_hex'],
                $params['passphrase']
            )) {
                throw new InvalidParameterException('Parameters key_type cannot be used with secret');
            }
        }

        if (isset($params['seed'])) {
            if (!isset($params['key_type'])) {
                throw new InvalidParameterException('key_type must be provided when using seed');
            }
            if (isset(
                $params['secret'],
                $params['seed_hex'],
                $params['passphrase']
            )) {
                throw new InvalidParameterException('Parameters secret, seed_hex, or passphrase cannot be used with seed');
            }
        }

        if (isset($params['seed_hex'])) {
            if (!isset($params['key_type'])) {
                throw new InvalidParameterException('key_type must be provided when using seed_hex');
            }
            if (isset(
                $params['secret'],
                $params['seed'],
                $params['passphrase']
            )) {
                throw new InvalidParameterException('Parameters secret, seed, or passphrase cannot be used with seed_hex');
            }
        }

        if (isset($params['passphrase'])) {
            if (!isset($params['key_type'])) {
                throw new InvalidParameterException('key_type must be provided when using passphrase');
            }
            if (isset(
                $params['secret'],
                $params['seed'],
                $params['seed_hex']
            )) {
                throw new InvalidParameterException('Parameters secret, seed, or seed_hex cannot be used with passphrase');
            }
        }

        if (isset($params['key_type'])) {
            if (isset($params['secret'])) {
                throw new InvalidParameterException('secret cannot be used with key_type');
            }
        }
    }

    /**
     * Executes the API call.
     *
     * @return MethodResponse
     * @throws \Exception
     */
    public function execute(): MethodResponse
    {
        return new MethodResponse($this->getClient()->post($this->method, $this->params));
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
    public function getParams(): ?array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params = null): void
    {
        $this->params = $params;
    }
}
