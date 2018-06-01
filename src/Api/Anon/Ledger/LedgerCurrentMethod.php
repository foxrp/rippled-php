<?php

namespace XRPHP\Api\Anon\Ledger;

use XRPHP\Api\Method;

/**
 * The ledger_current method returns the unique identifiers of the current in-progress ledger. This command is mostly
 * useful for testing, because the ledger returned is still in flux.
 *
 * @link https://developers.ripple.com/ledger_current.html Documentation of ledger_current.
 * @package XRPHP\Api\Anon\Ledger
 */
class LedgerCurrentMethod extends Method
{
    public function getValidParameters(): array
    {
        return [];
    }
}
