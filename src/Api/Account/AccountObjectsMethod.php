<?php

namespace XRPHP\Api\Account;

use XRPHP\Api\Method;

/**
 * The account_objects command returns the raw ledger format for all objects owned by an account. For a higher-level
 * view of an account's trust lines and balances, see the account_lines method instead.
 *
 * Object include:
 * - Offer objects          for orders that are currently live, unfunded, or expired but not yet removed.
 * - RippleState objects    for trust lines where this account's side is not in the default state.
 * - Escrow objects         for held payments that have not yet been executed or canceled.
 * - SignerList             if account has multi-singing available.
 * - PayChannel objects     for open payment channels.
 * - Check objects          for pending checks.
 *
 * @link https://developers.ripple.com/account_objects.html Documentation of account_objects.
 * @package XRPHP\Api\Account
 */
class AccountObjectsMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'type',
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
