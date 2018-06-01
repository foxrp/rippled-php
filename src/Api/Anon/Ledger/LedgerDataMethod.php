<?php

namespace XRPHP\Api\Anon\Ledger;

use XRPHP\Api\Method;

/**
 * The ledger_data method retrieves contents of the specified ledger. You can iterate through several calls to retrieve
 * the entire contents of a single ledger version.
 *
 * @link https://developers.ripple.com/ledger_data.html Documentation of ledger_data.
 * @package XRPHP\Api\Anon\Ledger
 */
class LedgerDataMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'ledger_hash',
            'ledger_index',
            'binary',
            'limit',
            'marker'
        ];
    }
}
