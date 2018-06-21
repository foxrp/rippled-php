<?php

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * EscrowFinish Transaction Type Class
 *
 * Deliver XRP from a held payment to the recipient.
 *
 * https://developers.ripple.com/escrowfinish.html EscrowFinish transaction type documentation.
 */
class EscrowFinish extends AbstractTransactionType
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

        parent::__construct($params);
    }
}
