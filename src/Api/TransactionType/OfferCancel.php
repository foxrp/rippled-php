<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * OfferCancel Transaction Type Class
 *
 * An OfferCancel transaction removes an Offer object from the XRP Ledger.
 *
 * @link https://developers.ripple.com/offercancel.html OfferCancel transaction type documentation.
 */
class OfferCancel extends AbstractTransactionType
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
            'name' => 'OfferSequence',
            'required' => true,
            'autoFillable' => false
        ]));

        // END GENERATED

    }
}
