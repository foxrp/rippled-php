<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * OfferCreate Transaction Type Class
 *
 * An OfferCreate transaction is effectively a limit order. It defines an intent to exchange currencies, and creates an
 * Offer object if not completely fulfilled when placed. Offers can be partially fulfilled.
 *
 * https://developers.ripple.com/offercreate.html OfferCreate transaction type documentation.
 */
class OfferCreate extends AbstractType
{
    /**
     * OfferCreate constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'TakerGets',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'TakerPays',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Expiration',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'OfferSequence',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
