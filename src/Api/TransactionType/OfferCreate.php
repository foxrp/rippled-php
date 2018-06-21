<?php

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * OfferCreate Transaction Type Class
 *
 * An OfferCreate transaction is effectively a limit order. It defines an intent to exchange currencies, and creates an
 * Offer object if not completely fulfilled when placed. Offers can be partially fulfilled.
 *
 * https://developers.ripple.com/offercreate.html OfferCreate transaction type documentation.
 */
class OfferCreate extends AbstractTransactionType
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
            'name' => 'TakerGets',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'TakerPays',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Expiration',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'OfferSequence',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
