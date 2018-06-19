<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * PaymentChannelFund Transaction Type Class
 *
 * Add additional XRP to an open payment channel, update the expiration time of the channel, or both. Only the source
 * address of the channel can use this transaction. (Transactions from other addresses fail with the error
 * tecNO_PERMISSION.)
 *
 * https://developers.ripple.com/paymentchannelfund.html PaymentChannelFund transaction type documentation.
 */
class PaymentChannelFund extends AbstractType
{
    /**
     * PaymentChannelFund constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'Channel',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Amount',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Expiration',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
