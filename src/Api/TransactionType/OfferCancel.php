<?php

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * OfferCancel Transaction Type Class
 *
 * An OfferCancel transaction removes an Offer object from the XRP Ledger.
 *
 * https://developers.ripple.com/offercancel.html OfferCancel transaction type documentation.
 */
class OfferCancel extends AbstractTransactionType
{
    /**
     * Constructor
     *
     * @param array|null $params Array of parameters to validate.
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new Field([
            'name' => 'OfferSequence',
            'required' => true,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
