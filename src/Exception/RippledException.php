<?php declare(strict_types=1);

namespace FOXRP\Rippled\Exception;

use Exception;

/**
 * Base exception for Rippled.
 */
class RippledException extends Exception
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
