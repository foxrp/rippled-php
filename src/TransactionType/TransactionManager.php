<?php

namespace XRPHP\Transaction;

use XRPHP\Client;

class TransactionManager
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getTransactionTypeClassMap(): array
    {
        return [
            'Payment' => \XRPHP\Transaction\PaymentTransaction::class
        ];
    }

    public function transaction(string $transactionType, array $params): TransactionInterface
    {
        $transactionMap = $this->getTransactionTypeClassMap();
        if (isset($transactionMap[$transactionType])) {
            return new $transactionMap[$transactionType]($this, $transactionType, $params);
        }
        throw new \BadMethodCallException(sprintf('Invalid transaction type: %s', $method));
    }

    public function sign(string $json, string $privateKey): string
    {
    }
}
