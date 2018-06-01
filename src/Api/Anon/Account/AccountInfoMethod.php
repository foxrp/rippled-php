<?php

namespace XRPHP\Api\Anon\Account;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The account_info command retrieves information about an account, its activity, and its XRP balance.
 * All information retrieved is relative to a particular version of the ledger.
 *
 * @link https://developers.ripple.com/account_info.html Documentation of account_info.
 * @package XRPHP\Api\Account
 */
class AccountInfoMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'strict',
            'ledger_hash',
            'ledger_index',
            'queue',
            'signer_lists'
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
