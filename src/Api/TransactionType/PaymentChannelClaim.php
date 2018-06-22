<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * PaymentChannelClaim Transaction Type Class
 *
 * Claim XRP from a payment channel, adjust the payment channel's expiration, or both. This transaction can be used
 * differently depending on the transaction sender's role in the specified channel.
 *
 * @link https://developers.ripple.com/paymentchannelclaim.html PaymentChannelClaim transaction type documentation.
 */
class PaymentChannelClaim extends AbstractTransactionType
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
        $this->addField(new Field([
            'name' => 'Channel',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Balance',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Amount',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Signature',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'PublicKey',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED
    }
}
