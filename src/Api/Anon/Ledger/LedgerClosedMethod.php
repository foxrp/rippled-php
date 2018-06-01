<?php

namespace XRPHP\Api\Anon\Ledger;

use XRPHP\Api\Method;

/**
 * The ledger_closed method returns the unique identifiers of the most recently closed ledger. (This ledger is not
 * necessarily validated and immutable yet.)
 *
 * @link https://developers.ripple.com/ledger_closed.html Documentation of ledger_closed.
 * @package XRPHP\Api\Anon\Ledger
 */
class LedgerClosedMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'ledger_hash',
            'ledger_index'
        ];
    }
}
