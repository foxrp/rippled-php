<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * Payment Transaction Type Class
 *
 * A Payment transaction represents a transfer of value from one account to another. (Depending on the path taken, this
 * can involve additional exchanges of value, which occur atomically.)
 *
 * @link https://developers.ripple.com/payment.html Payment transaction type documentation.
 */
class Payment extends AbstractTransactionType
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
            'name' => 'Amount',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Destination',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'DestinationTag',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'InvoiceID',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Paths',
            'required' => false,
            'autoFillable' => true
        ]));

        $this->addField(new Field([
            'name' => 'SendMax',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'DeliverMin',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED
    }
}
