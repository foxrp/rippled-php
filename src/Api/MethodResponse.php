<?php

namespace XRPHP\Api;

use Psr\Http\Message\ResponseInterface;

class MethodResponse
{
    /** @var string The raw response body returned from the API */
    private $raw;

    /** @var array Result block data returned from the API */
    private $result;

    /** @var bool True when result status is success */
    private $success;

    /** @var bool Validated flag from the result block */
    private $validated;

    /**
     * MethodResponse constructor.
     *
     * @param ResponseInterface $response
     * @throws \Exception
     */
    public function __construct(ResponseInterface $response)
    {
        $this->processResponse($response);
    }

    /**
     * Validates and assigns data from response.
     *
     * @param ResponseInterface $response
     * @throws \Exception
     */
    private function processResponse(ResponseInterface $response): void
    {
        $data = null;
        $this->raw = $response->getBody()->__toString();
        
        if (!strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            throw new \Exception('API response missing header: Content-Type: application/json');
        }
        
        $data = json_decode($this->raw, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception('Unable to parse JSON in API response');
        }

        if (!\is_array($data) || !isset($data['result'])) {
            throw new \Exception('API response missing result data');
        }

        $this->result = $data['result'];

        $this->success = $this->result['status'] === 'success';
        $this->validated = $this->result['validated'] ?? null;
    }

    /**
     * @return string
     */
    public function getRaw(): string
    {
        return $this->raw;
    }

    /**
     * @param string $raw
     */
    public function setRaw(string $raw): void
    {
        $this->raw = $raw;
    }

    /**
     * @return array
     */
    public function getResult(): ?array
    {
        return $this->result;
    }

    /**
     * @param array $result
     */
    public function setResult(array $result): void
    {
        $this->result = $result;
    }

    /**
     * @return bool
     */
    public function isSuccess(): ?bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    /**
     * @return bool
     */
    public function isValidated(): ?bool
    {
        return $this->validated;
    }

    /**
     * @param bool $validated
     */
    public function setValidated(bool $validated): void
    {
        $this->validated = $validated;
    }
}
