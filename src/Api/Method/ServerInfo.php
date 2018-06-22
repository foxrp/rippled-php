<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * ServerInfo Method Class
 *
 * The server_info command asks the server for a human-readable version of various information about the rippled server
 * being queried.
 *
 * @link https://developers.ripple.com/server_info.html ServerInfo method documentation.
 */
class ServerInfo extends AbstractMethod
{
    /**
     * {@inheritDoc}
     *
     * @throws \XRPHP\Exception\FieldException
     */
    public function setFields(): void
    {
        parent::setFields();

        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        // END GENERATED
    }
}
