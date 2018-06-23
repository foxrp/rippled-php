<?php declare(strict_types=1);

namespace FOXRP\Rippled\Api\TransactionType;

use FOXRP\Rippled\Api\Field;

/**
 * CheckCreate Transaction Type Class
 *
 * Create a Check object in the ledger, which is a deferred payment that can be cashed by its intended destination. The
 * sender of this transaction is the sender of the Check.
 *
 * @link https://developers.ripple.com/checkcreate.html CheckCreate transaction type documentation.
 */
class CheckCreate extends AbstractTransactionType
{
    /**
     * {@inheritDoc}
     *
     * @throws \FOXRP\Rippled\Exception\FieldException
     */
    public function setFields(): void
    {
        parent::setFields();

        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new Field([
            'name' => 'Destination',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'SendMax',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'DestinationTag',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Expiration',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'InvoiceID',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED
    }
}
