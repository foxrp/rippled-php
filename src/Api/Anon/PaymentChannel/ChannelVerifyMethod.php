<?php

namespace XRPHP\Api\Anon\PaymentChannel;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The channel_verify method checks the validity of a signature that can be used to redeem a specific amount of XRP
 * from a payment channel.
 *
 * @link https://developers.ripple.com/channel_verify.html Documentation of channel_verify.
 * @package XRPHP\Api\PathOrderBook
 */
class ChannelVerifyMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'amount',
            'channel_id',
            'public_key',
            'signature'
        ];
    }

    /**
     * Validates parameters.
     *
     * @param array|null $params
     * @throws InvalidParameterException
     */
    public function validateParameters(array $params = null): void
    {
        if (!isset($params['amount'])) {
            throw new InvalidParameterException('Missing parameter: amount');
        }

        if (!isset($params['channel_id'])) {
            throw new InvalidParameterException('Missing parameter: channel_id');
        }

        if (!isset($params['public_key'])) {
            throw new InvalidParameterException('Missing parameter: public_key');
        }

        if (!isset($params['signature'])) {
            throw new InvalidParameterException('Missing parameter: signature');
        }
    }
}
