<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * EscrowFinish Transaction Type Class
 *
 * Deliver XRP from a held payment to the recipient.
 *
 * @link https://developers.ripple.com/escrowfinish.html EscrowFinish transaction type documentation.
 */
class EscrowFinish extends AbstractTransactionType
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
            'name' => 'Owner',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'OfferSequence',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Condition',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Fulfillment',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED
    }
}
