<?php

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * EscrowCancel Transaction Type Class
 *
 * Return escrowed XRP to the sender.
 *
 * https://developers.ripple.com/escrowcancel.html EscrowCancel transaction type documentation.
 */
class EscrowCancel extends AbstractTransactionType
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

        // END GENERATED

        parent::__construct($params);
    }
}
