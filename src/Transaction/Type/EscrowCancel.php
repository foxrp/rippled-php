<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * EscrowCancel Transaction Type Class
 *
 * Return escrowed XRP to the sender.
 *
 * https://developers.ripple.com/escrowcancel.html EscrowCancel transaction type documentation.
 */
class EscrowCancel extends AbstractType
{
    /**
     * EscrowCancel constructor.
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

        // END GENERATED

        parent::__construct($params);
    }
}
