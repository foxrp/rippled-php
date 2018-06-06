<?php

namespace XRPHP\Api\Anon\Utility;

use XRPHP\Api\Method;

/**
 * The ping command returns an acknowledgement, so that clients can test the connection status and latency.
 *
 * @link https://developers.ripple.com/ping.html Documentation of ping.
 * @package XRPHP\Api\PathOrderBook
 */
class PingMethod extends Method
{
    public function getValidParameters(): array
    {
        return [];
    }
}
