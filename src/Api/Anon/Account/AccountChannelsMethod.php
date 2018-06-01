<?php

namespace XRPHP\Api\Anon\Account;

use XRPHP\Api\Method;

/**
 * The account_channels method returns information about an account's Payment Channels.
 * This includes only channels where the specified account is the channel's source, not the
 * destination. (A channel's "source" and "owner" are the same.) All information retrieved is
 * relative to a particular version of the ledger.
 *
 * @link https://developers.ripple.com/account_channels.html Documentation of account_channels.
 * @package XRPHP\Api\Account
 */
class AccountChannelsMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'destination_account',
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
