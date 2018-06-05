<?php

namespace XRPHP\Api\Anon\ServerInfo;

use XRPHP\Api\Method;

/**
 * The server_info command asks the server for a human-readable version of various information about the rippled server
 * being queried.
 *
 * @link https://developers.ripple.com/server_info.html Documentation of server_info.
 * @package XRPHP\Api\PathOrderBook
 */
class ServerInfoMethod extends Method
{
    public function getValidParameters(): array
    {
        return [];
    }
}
