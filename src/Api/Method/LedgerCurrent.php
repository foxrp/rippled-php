<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * LedgerCurrent Method Class
 *
 * The ledger_current method returns the unique identifiers of the current in-progress ledger. This command is mostly
 * useful for testing, because the ledger returned is still in flux.
 *
 * https://developers.ripple.com/ledger_current.html LedgerCurrent method documentation.
 */
class LedgerCurrent extends AbstractMethod
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
