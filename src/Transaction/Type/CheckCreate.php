<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * CheckCreate Transaction Type Class
 *
 * Create a Check object in the ledger, which is a deferred payment that can be cashed by its intended destination. The
 * sender of this transaction is the sender of the Check.
 *
 * https://developers.ripple.com/checkcreate.html CheckCreate transaction type documentation.
 */
class CheckCreate extends AbstractType
{
    /**
     * CheckCreate constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'Destination',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'SendMax',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'DestinationTag',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Expiration',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'InvoiceID',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
