<?php

namespace XRPHP\Api\Anon\Account;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The noripple_check command provides a quick way to check the status of the DefaultRipple field for an account and
 * the NoRipple flag of its trust lines, compared with the recommended settings.
 *
 * @link https://developers.ripple.com/noripple_check.html Documentation of noripple_check.
 * @package XRPHP\Api\Account
 */
class NorippleCheckMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'role',
            'ledger_hash',
            'ledger_index',
            'limit',
            'transactions'
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
