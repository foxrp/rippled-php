<?php

namespace XRPHP\Exception;

use Exception;

/**
 * A base exception for XRPHP.
 *
 * @package XRPHP\Exception
 */
class XRPHPException extends Exception
{
    // Require a message in the constructor.
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
