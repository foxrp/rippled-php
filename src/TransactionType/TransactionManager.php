<?php

namespace XRPHP\Transaction;

use XRPHP\Client;
use XRPHP\Exception\InvalidParameterException;
use XRPHP\TransactionType\TransactionTypeInterface;

class TransactionManager
{
    /** @var array */
    private $transactionTypes;

    public function __construct()
    {
        $this->transactionTypes  = $this->getTransactionTypeClassMap();
    }

    public function getTransactionTypeClassMap(): array
    {
        return [
            'Payment' => \XRPHP\TransactionType\PaymentTransactionType::class
        ];
    }

    /**
     * @param array $params
     * @return string
     * @throws InvalidParameterException
     */
    public function getTx(array $params): string
    {
        $transactionType = $params['TransactionType'] ?? null;

        if ($transactionType === null || !isset($this->transactionTypes[$transactionType])) {
            throw new InvalidParameterException(sprintf('Invalid transaction type: %s', $transactionType));
        }

        /** @var TransactionTypeInterface $tt */
        $tt = new $params['TransactionType']();
        return $tt->getTx($params);
    }

    public function sign(string $json, string $privateKey): string
    {
    }
}
