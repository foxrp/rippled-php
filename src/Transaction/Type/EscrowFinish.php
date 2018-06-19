<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * EscrowFinish Transaction Type Class
 *
 * Deliver XRP from a held payment to the recipient.
 *
 * https://developers.ripple.com/escrowfinish.html EscrowFinish transaction type documentation.
 */
class EscrowFinish extends AbstractType
{
    /**
     * EscrowFinish constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'Owner',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'OfferSequence',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Condition',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Fulfillment',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
