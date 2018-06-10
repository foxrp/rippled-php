<?php

namespace XRPHP;

use Symfony\Component\Process\Process;
use XRPHP\Exception\TransactionException;
use XRPHP\Exception\TransactionSignException;
use XRPHP\Exception\TransactionTypeException;
use XRPHP\TransactionType\TransactionTypeMap;
use XRPHP\TransactionType\TransactionTypeInterface;

class Transaction
{
    /** @var string */
    private $json;

    /** @var bool */
    private $signed;

    /** @var TransactionTypeInterface */
    private $type;

    /** @var array */
    private $tx;

    /**
     * Transaction constructor.
     * @param array|string $tx A transaction represented by JSON or an associative array.
     * @throws TransactionException
     * @throws TransactionTypeException
     */
    public function __construct($tx)
    {
        // Dynamically set tx & json based on type.
        if (\is_array($tx)) {
            $this->setTx($tx);
        } elseif (\is_string($tx)) {
            $this->setJson($tx);
        } else {
            throw new TransactionException('Invalid tx passed into the constructor; Must be a string or array');
        }

        $this->setType();
    }

    /**
     * @param string $secret
     * @throws TransactionSignException
     */
    public function sign(string $secret): void
    {
        $cmd = sprintf("xrpsign '%s' '%s'", $secret, $this->getJson());
        $process = new Process($cmd);

        try {
            $process->run();
            if (!$process->isSuccessful()) {
                $response['stderr'] = trim($process->getErrorOutput());
                throw new TransactionSignException(sprintf('Unable to sign transaction: %s', $process->getErrorOutput()));
            }

            $json = trim($process->getOutput());
            $this->setJson($json);
            $this->setSigned(true);

        } catch(\Exception $e) {
            throw new TransactionSignException('Unable to sign transaction: ' . $e->getMessage());
        }
    }

    /**
     * @return string
     */
    public function getJson(): string
    {
        return $this->json;
    }

    /**
     * @param string $json
     * @throws TransactionException
     */
    public function setJson(string $json): void
    {
        $tx = json_decode($json, true);
        if (json_last_error()!== JSON_ERROR_NONE) {
            throw new TransactionException('Invalid JSON passed into the constructor');
        }

        $this->json = $json;
        $this->tx = $tx;
    }

    /**
     * @return bool
     */
    public function isSigned(): bool
    {
        return $this->signed;
    }

    /**
     * @param bool $signed
     */
    public function setSigned(bool $signed): void
    {
        $this->signed = $signed;
    }

    /**
     * @return array
     */
    public function getTx(): array
    {
        return $this->tx;
    }

    /**
     * @param array $tx
     */
    public function setTx(array $tx): void
    {
        $this->tx = $tx;
        $this->json = json_encode($tx);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @throws Exception\TransactionTypeException
     * @throws TransactionException
     */
    public function setType(): void
    {
        $tx = $this->getTx();
        if (!isset($tx['TransactionType'])) {
            throw new TransactionException('TransactionType is required');
        }

        $txType = $tx['TransactionType'];
        $class = TransactionTypeMap::FindClass($txType);
        $this->type = new $class($this, $txType, $tx);
    }
}
