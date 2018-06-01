<?php

namespace XRPHP\Api\Anon\Account;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The gateway_balances command calculates the total balances issued by a given account, optionally excluding amounts
 * held by operational addresses.
 *
 * @link https://developers.ripple.com/gateway_balances.html Documentation of gateway_balances.
 * @package XRPHP\Api\Account
 */
class GatewayBalancesMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'strict',
            'hotwallet',
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
