<?php

namespace XRPHP\Api\Anon\Account;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The account_lines method returns information about an account's trust lines, including balances in all
 * non-XRP currencies and assets. All information retrieved is relative to a particular version of the ledger.
 *
 * @link https://developers.ripple.com/account_lines.html#request-format Documentation of account_lines.
 * @package XRPHP\Api\Account
 */
class AccountLinesMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'ledger_hash',
            'ledger_index',
            'peer',
            'limit',
            'marker'
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
