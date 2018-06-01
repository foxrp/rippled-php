<?php

namespace XRPHP\Api\Anon\Account;

use XRPHP\Api\Method;

/**
 * The account_offers method retrieves a list of offers made by a given account that are outstanding as of a particular
 * ledger version.
 *
 * @link https://developers.ripple.com/account_offers.html Documentation of account_offers.
 * @package XRPHP\Api\Account
 */
class AccountOffersMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'ledger_hash',
            'ledger_index',
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
    }
}
