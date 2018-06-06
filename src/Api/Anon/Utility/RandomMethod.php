<?php

namespace XRPHP\Api\Anon\Utility;

use XRPHP\Api\Method;

/**
 * The random command provides a random number to be used as a source of entropy for random number generation by
 * clients.
 *
 * @link https://developers.ripple.com/random.html Documentation of random.
 * @package XRPHP\Api\PathOrderBook
 */
class RandomMethod extends Method
{
    public function getValidParameters(): array
    {
        return [];
    }
}
