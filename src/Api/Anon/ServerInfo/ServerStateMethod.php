<?php

namespace XRPHP\Api\Anon\ServerInfo;

use XRPHP\Api\Method;

/**
 * TThe server_state command asks the server for various machine-readable information about the rippled server's current
 * state. The response is almost the same as the server_info method, but uses units that are easier to process instead
 * of easier to read. (For example, XRP values are given in integer drops instead of scientific notation or decimal
 * values, and time is given in milliseconds instead of seconds.)
 *
 * @link https://developers.ripple.com/server_state.html Documentation of server_state.
 * @package XRPHP\Api\PathOrderBook
 */
class ServerStateMethod extends Method
{
    public function getValidParameters(): array
    {
        return [];
    }
}
