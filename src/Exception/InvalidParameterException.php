<?php

namespace XRPHP\Exception;

use Exception;

/**
 * An exception for parameter validation errors.
 *
 * @package XRPHP\Exception
 */
class InvalidParameterException extends Exception
{
    // Require a message in the constructor.
    public function __construct($message, $code = 0, Exception $previous = null) {

        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
