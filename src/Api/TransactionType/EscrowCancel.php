<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * EscrowCancel Transaction Type Class
 *
 * Return escrowed XRP to the sender.
 *
 * @link https://developers.ripple.com/escrowcancel.html EscrowCancel transaction type documentation.
 */
class EscrowCancel extends AbstractTransactionType
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

        // END GENERATED

    }
}
