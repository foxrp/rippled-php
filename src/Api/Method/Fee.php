<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * Fee Method Class
 *
 * The fee command reports the current state of the open-ledger requirements for the transaction cost. This requires the
 * FeeEscalation amendment to be enabled.
 *
 * https://developers.ripple.com/fee.html Fee method documentation.
 */
class Fee extends AbstractMethod
{
    /**
     * Constructor.
     *
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        // END GENERATED

        parent::__construct($params);
    }
}
