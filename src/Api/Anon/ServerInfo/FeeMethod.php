<?php

namespace XRPHP\Api\Anon\ServerInfo;

use XRPHP\Api\Method;

/**
 * The fee command reports the current state of the open-ledger requirements for the transaction cost. This requires the
 * FeeEscalation amendment to be enabled.
 *
 * @link https://developers.ripple.com/fee.html Documentation of fee.
 * @package XRPHP\Api\PathOrderBook
 */
class FeeMethod extends Method
{
    public function getValidParameters(): array
    {
        return [];
    }
}
