<?php

namespace XRPHP\Api\Anon\Account;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The account_currencies command retrieves a list of currencies that an account
 * can send or receive, based on its trust lines. (This is not a thoroughly
 * confirmed list, but it can be used to populate user interfaces.)
 *
 * @link https://developers.ripple.com/account_currencies.html Documentation of account_currencies.
 * @package XRPHP\Api\Account
 */
class AccountCurrenciesMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'strict',
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
        if (!isset($params['account'])) {
            throw new InvalidParameterException('Missing parameter: account');
        }
    }
}
