<?php

namespace XRPHP\Api\Anon\Ledger;

use XRPHP\Api\Method;

/**
 * Retrieve information about the public ledger.
 *
 * @link https://developers.ripple.com/ledger.html Documentation of ledger.
 * @package XRPHP\Api\Anon\Ledger
 */
class LedgerMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'ledger_hash',
            'ledger_index',
            'full',
            'accounts',
            'transactions',
            'expand',
            'owner_funds',
            'binary',
            'queue'
        ];
    }
}
