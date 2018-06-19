<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * Payment Transaction Type Class
 *
 * A Payment transaction represents a transfer of value from one account to another. (Depending on the path taken, this
 * can involve additional exchanges of value, which occur atomically.)
 *
 * https://developers.ripple.com/payment.html Payment transaction type documentation.
 */
class Payment extends AbstractType
{
    /**
     * Payment constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'Amount',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Destination',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'DestinationTag',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'InvoiceID',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Paths',
            'required' => false,
            'autoFillable' => true
        ]));

        $this->addField(new TypeField([
            'name' => 'SendMax',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'DeliverMin',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
