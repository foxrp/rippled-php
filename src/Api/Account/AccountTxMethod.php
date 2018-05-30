<?php

namespace XRPHP\Api\Account;

use XRPHP\Api\Method;

/**
 * The account_tx method retrieves a list of transactions that involved the specified account.
 *
 * @link https://developers.ripple.com/account_tx.html Documentation of account_tx.
 * @package XRPHP\Api\Account
 */
class AccountTxMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'ledger_index_min',
            'ledger_index_max',
            'ledger_hash',
            'ledger_index',
            'binary',
            'forward',
            'limit',
            'marker'
        ];
    }

    /**
     * Validates parameters.
     *
     * @param array|null $params
     * @throws \BadMethodCallException
     */
    public function validateParameters(array $params = null): void
    {
        if (!isset($params['account'])) {
            throw new \BadMethodCallException('Missing parameter: account');
        }

        if (!isset($params['ledger_index_min'], $params['ledger_index_max'], $params['ledger_hash'], $params['ledger_index'])) {
            throw new \BadMethodCallException('At least one of the following parameters must be used: ledger_index, ledger_hash, ledger_index_min, ledger_index_max');
        }
    }
}
