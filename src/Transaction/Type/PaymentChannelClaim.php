<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * PaymentChannelClaim Transaction Type Class
 *
 * Claim XRP from a payment channel, adjust the payment channel's expiration, or both. This transaction can be used
 * differently depending on the transaction sender's role in the specified channel.
 *
 * https://developers.ripple.com/paymentchannelclaim.html PaymentChannelClaim transaction type documentation.
 */
class PaymentChannelClaim extends AbstractType
{
    /**
     * PaymentChannelClaim constructor.
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
            'name' => 'Balance',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Amount',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Signature',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'PublicKey',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
