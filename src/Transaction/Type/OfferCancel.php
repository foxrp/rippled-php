<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * OfferCancel Transaction Type Class
 *
 * An OfferCancel transaction removes an Offer object from the XRP Ledger.
 *
 * https://developers.ripple.com/offercancel.html OfferCancel transaction type documentation.
 */
class OfferCancel extends AbstractType
{
    /**
     * OfferCancel constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'OfferSequence',
            'required' => true,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
