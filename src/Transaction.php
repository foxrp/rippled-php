<?php

namespace XRPHP;

use Symfony\Component\Process\Process;
use XRPHP\Api\MethodResponse;
use XRPHP\Exception\TransactionException;
use XRPHP\Exception\TransactionSignException;
use XRPHP\Exception\TransactionTypeException;
use XRPHP\Transaction\TypeInterface;
use XRPHP\Transaction\TypeMap;

class Transaction
{
    /** @var Client */
    private $client;

    /** @var string */
    private $json;

    /** @var bool */
    private $signed;

    /** @var TypeInterface */
    private $type;

    /** @var array */
    private $tx;

    /** @var string */
    private $txBlob;

    /** @var string */
    private $txId;

    /**
     * Transaction constructor.
     * @param array|string $tx A transaction represented by JSON or an associative array.
     * @param Client|null $client
     * @throws TransactionException
     * @throws TransactionTypeException
     */
    public function __construct($tx, Client $client = null)
    {
        // Dynamically set tx & json based on type.
        if (\is_array($tx)) {
            $this->setTx($tx);
        } elseif (\is_string($tx)) {
            $this->setJson($tx);
        } else {
            throw new TransactionException('Invalid tx passed into the constructor; Must be a string or array');
        }

        if ($client !== null) {
            $this->setClient($client);
        }
    }

    /**
     * @param string $secret
     * @throws TransactionSignException
     * @throws TransactionTypeException
     * @throws TransactionException
     */
    public function signLocal(string $secret): void
    {
        // Auto-fillable fields are required before signing.
        $tx = $this->getTx();

        // Set sequence if it does not exist.
        if (!isset($tx['Sequence']) || $tx['Sequence'] < 1) {
            $tx['Sequence'] = $this->getAccountSequence($tx['Account']);
            $this->setTx($tx);
        }

        // Build/run command.
        $cmd = sprintf("xrpsign '%s' '%s'", $this->getJson(), $secret);

        $process = new Process($cmd);

        try {
            $process->run();
            if (!$process->isSuccessful()) {
                $response['stderr'] = trim($process->getErrorOutput());
                throw new TransactionSignException(sprintf('Unable to sign transaction: %s', $process->getErrorOutput()));
            }

            $json = trim($process->getOutput());
            $data = json_decode($json, true);
            if (json_last_error()!== JSON_ERROR_NONE) {
                throw new TransactionSignException('Unable to parse output of xrpsign command');
            }

            $this->setTx($data['tx']);
            $this->setTxBlob($data['tx_blob']);
            $this->setTxId($data['tx_id']);
            $this->setSigned(true);

        } catch(\Exception $e) {
            throw new TransactionSignException('Unable to sign transaction: ' . $e->getMessage());
        }
    }

    /**
     * @throws TransactionSignException
     */
    public function getAccountSequence(string $account): int
    {
        $client = $this->getClient();
        if ($client === null) {
            throw new TransactionSignException('Client must be present if Sequence paramter does not exist');
        }

        $params = [
            'account' => $account,
        ];

        $method = $client->method('account_info', $params);
        $res = $method->execute();

        return $res->getResult()['account_data']['Sequence'];
    }

    /**
     * Submit this transaction, signed or unsigned.
     *
     * @param string $secret Regular key.
     * @param bool $signLocal Sign locally.
     * @return MethodResponse|null
     * @throws TransactionException
     * @throws \Exception
     */
    public function submit(string $secret, bool $signLocal = true)
    {
        if ($this->getClient() === null) {
            throw new TransactionException('Transaction must have a Client to submit');
        }

        $res = null;
        if ($signLocal) {

            $this->signLocal($secret);

            $txBlob = $this->getTxBlob();
            if ($txBlob === null) {
                throw new TransactionException('Local sign was unsuccessful.');
            }

            // Submit signed transaction.
            $res = $this->getClient()->method('submit', [
                'tx_blob' => $txBlob
            ])->execute();

        } else {
            // Submit unsigned transaction with secret.
            // TODO: Handle sign-and-submit
            $res = null;
        }

        return $res;
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
     * @throws TransactionTypeException
     */
    public function setJson(string $json): void
    {
        $tx = json_decode($json, true);
        if (json_last_error()!== JSON_ERROR_NONE) {
            throw new TransactionException('Invalid JSON passed into the constructor');
        }

        $this->json = $json;
        $this->tx = $tx;
        $this->setType();
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
     * @throws TransactionException
     * @throws TransactionTypeException
     */
    public function setTx(array $tx): void
    {
        $this->tx = $tx;
        $this->json = json_encode($tx);
        $this->setType();
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @throws TransactionException
     * @throws TransactionTypeException
     */
    public function setType(): void
    {
        $tx = $this->getTx();
        if (!isset($tx['TransactionType'])) {
            throw new TransactionException('TransactionType is required');
        }

        $txType = $tx['TransactionType'];
        $class = TypeMap::FindClass($txType);
        $this->type = new $class($tx);
    }

    /**
     * @return string
     */
    public function getTxBlob(): ?string
    {
        return $this->txBlob;
    }

    /**
     * @param string $txBlob
     */
    public function setTxBlob(string $txBlob = null): void
    {
        $this->txBlob = $txBlob;
    }

    /**
     * @return string
     */
    public function getTxId(): ?string
    {
        return $this->txId;
    }

    /**
     * @param string $txId
     */
    public function setTxId(string $txId = null): void
    {
        $this->txId = $txId;
    }

    /**
     * @return Client
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client = null): void
    {
        $this->client = $client;
    }
}
