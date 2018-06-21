<?php

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * CheckCancel Transaction Type Class
 *
 * Cancels an unredeemed Check, removing it from the ledger without sending any money. The source or the destination of
 * the check can cancel a Check at any time using this transaction type. If the Check has expired, any address can
 * cancel it.
 *
 * https://developers.ripple.com/checkcancel.html CheckCancel transaction type documentation.
 */
class CheckCancel extends AbstractTransactionType
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
            'name' => 'CheckID',
            'required' => true,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
