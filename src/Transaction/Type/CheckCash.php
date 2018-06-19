<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * CheckCash Transaction Type Class
 *
 * Attempts to redeem a Check object in the ledger to receive up to the amount authorized by the corresponding
 * CheckCreate transaction. Only the Destination address of a Check can cash it with a CheckCash transaction. Cashing a
 * check this way is similar to executing a Payment initiated by the destination.\n\nSince the funds for a check are not
 * guaranteed, redeeming a Check can fail because the sender does not have a high enough balance or because there is not
 * enough liquidity to deliver the funds. If this happens, the Check remains in the ledger and the destination can try
 * to cash it again later, or for a different amount.
 *
 * https://developers.ripple.com/checkcancel.html CheckCash transaction type documentation.
 */
class CheckCash extends AbstractType
{
    /**
     * CheckCash constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'CheckID',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Amount',
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
