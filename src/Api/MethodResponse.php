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

    /** @var bool */
    private $error = false;

    /** @var int */
    private $errorCode;

    /** @var string */
    private $errorMessage;

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
    public function processResponse(ResponseInterface $response): void
    {
        $data = null;
        $this->setRaw($response->getBody()->__toString());

        if ($response->getHeaderLine('Content-Type') !== 'application/json') {
            throw new \Exception('API response missing header: Content-Type: application/json');
        }
        
        $data = json_decode($this->raw, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception('Unable to parse JSON in API response');
        }

        if (!\is_array($data) || !isset($data['result'])) {
            throw new \Exception('API response missing result data');
        }

        $this->setResult($data['result']);

        $this->setSuccess($data['result']['status'] === 'success');
        $this->setValidated($data['result']['validated'] ?? null);

        // Set error data.
        if ($data['result']['status'] === 'error') {
            $this->setError(true);
            $this->setErrorCode($data['result']['error_code']);
            $this->setErrorMessage($data['result']['error_message']);
        }
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
    public function setValidated(bool $validated = null): void
    {
        $this->validated = $validated;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return $this->error;
    }

    /**
     * @param bool $error
     */
    public function setError(bool $error): void
    {
        $this->error = $error;
    }

    /**
     * @return int
     */
    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     */
    public function setErrorCode(int $errorCode = null): void
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage = null): void
    {
        $this->errorMessage = $errorMessage;
    }
}
