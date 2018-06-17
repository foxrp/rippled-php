<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * Cancels an unredeemed Check, removing it from the ledger without sending any money. The source or the destination of
 * the check can cancel a Check at any time using this transaction type. If the Check has expired, any address can cancel it.
 *
 * @link https://developers.ripple.com/checkcancel.html CheckCancel transaction type documentation.
 * @package XRPHP\TransactionType
 */
class CheckCancel extends AbstractType
{
    /**
     * CheckCancel constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        $this->addField(new TypeField([
            'name' => 'CheckID',
            'description' => 'The ID of the Check ledger object to cancel, as a 64-character hexadecimal string.',
            'jsonType' => 'String',
            'required' => true
        ]));

        parent::__construct($params);
    }
}
