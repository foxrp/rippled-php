<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * EscrowCreate Transaction Type Class
 *
 * Sequester XRP until the escrow process either finishes or is canceled.
 *
 * https://developers.ripple.com/escrowcreate.html EscrowCreate transaction type documentation.
 */
class EscrowCreate extends AbstractType
{
    /**
     * EscrowCreate constructor.
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
            'name' => 'CancelAfter',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'FinishAfter',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Condition',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'DestinationTag',
            'required' => true,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
