<?php

namespace XRPHP\Api\Anon\PaymentChannel;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The channel_authorize method creates a signature that can be used to redeem a specific amount of XRP from a payment
 * channel.
 *
 * @link https://developers.ripple.com/channel_authorize.html Documentation of channel_authorize.
 * @package XRPHP\Api\PathOrderBook
 */
class ChannelAuthorizeMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'channel_id',
            'secret',
            'amount'
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
        if (!isset($params['channel_id'])) {
            throw new InvalidParameterException('Missing parameter: channel_id');
        }

        if (!isset($params['secret'])) {
            throw new InvalidParameterException('Missing parameter: secret');
        }

        if (!isset($params['amount'])) {
            throw new InvalidParameterException('Missing parameter: amount');
        }
    }
}
