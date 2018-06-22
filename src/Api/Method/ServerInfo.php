<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * ServerInfo Method Class
 *
 * The server_info command asks the server for a human-readable version of various information about the rippled server
 * being queried.
 *
 * https://developers.ripple.com/server_info.html ServerInfo method documentation.
 */
class ServerInfo extends AbstractMethod
{
    /**
     * Constructor.
     *
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        // END GENERATED

        parent::__construct($params);
    }
}
