<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * ChannelAuthorize Method Class
 *
 * The channel_authorize method creates a signature that can be used to redeem a specific amount of XRP from a payment
 * channel.
 *
 * https://developers.ripple.com/channel_authorize.html ChannelAuthorize method documentation.
 */
class ChannelAuthorize extends AbstractMethod
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
        $this->addField(new Field([
            'name' => 'channel_id',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'secret',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'amount',
            'required' => true
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
