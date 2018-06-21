<?php

namespace XRPHP\Api;

use XRPHP\Client;

class Request
{
    /** @var Client */
    private $client;

    /** @var MethodInterface */
    private $method;

    /** @var string */
    private $methodName;

    /** @var array */
    private $params;

    /**
     * Request constructor.
     * @param string $methodName
     * @param array $params
     * @param Client|null $client
     * @throws \Exception
     */
    public function __construct(string $methodName, array $params, Client $client = null)
    {
        $this->setMethod($methodName, $params);

        if ($client !== null) {
            $this->setClient($client);
        }
    }

    /**
     * @return MethodResponse
     * @throws \Exception
     */
    public function send()
    {
        return new MethodResponse($this->client->post($this->methodName, $this->params));
    }

    /**
     * Returns class path from API snake cased method name.
     *
     * @param string $methodName Snake cased method name.
     * @return string Class path to the method.
     * @throws \Exception
     */
    private function findClass(string $methodName): string
    {
        $class = '\\XRPHP\\Api\\Method\\' . \XRPHP\Util::CaseFromSnake($methodName);
        if (!class_exists($class)) {
            throw new \Exception(sprintf('No class found for method: %s', $methodName));
        }
        return $class;
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
     * @return MethodInterface
     */
    public function getMethod(): MethodInterface
    {
        return $this->method;
    }

    /**
     * @param string $methodName
     * @param array|null $params
     * @throws \Exception
     */
    public function setMethod(string $methodName, array $params = null): void
    {
        $this->methodName = $methodName;
        $this->params = $params;

        $methodClass = $this->findClass($methodName);
        $this->method = new $methodClass($params);
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
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
