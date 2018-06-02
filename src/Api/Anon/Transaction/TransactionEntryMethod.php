<?php

namespace XRPHP\Api\Anon\Account;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The transaction_entry method retrieves information on a single transaction from a specific ledger version. (The tx
 * method, by contrast, searches all ledgers for the specified transaction. We recommend using that method instead.)
 *
 * @link https://developers.ripple.com/transaction_entry.html Documentation of transaction_entry.
 * @package XRPHP\Api\Transaction
 */
class TransactionEntryMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'tx_hash',
            'ledger_hash',
            'ledger_index'
        ];
    }

    /**
     * Validates parameters.
     *
     * @param array|null $params
     * @throws InvalidParameterException
     */
    public function validateParameters(array $params = null): void
    {
        if (!isset($params['tx_hash'])) {
            throw new InvalidParameterException('Missing parameter: tx_hash');
        }
    }
}
