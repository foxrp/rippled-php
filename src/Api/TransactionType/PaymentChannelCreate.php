<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * PaymentChannelCreate Transaction Type Class
 *
 * Create a unidirectional channel and fund it with XRP. The address sending this transaction becomes the "source
 * address" of the payment channel.
 *
 * @link https://developers.ripple.com/paymentchannelcreate.html PaymentChannelCreate transaction type documentation.
 */
class PaymentChannelCreate extends AbstractTransactionType
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
            'name' => 'Balance',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Destination',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'SettleDelay',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'PublicKey',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'CancelAfter',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'DestinationTag',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

    }
}
