<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * LedgerClosed Method Class
 *
 * The ledger_closed method returns the unique identifiers of the most recently closed ledger. (This ledger is not
 * necessarily validated and immutable yet.)
 *
 * https://developers.ripple.com/ledger_closed.html LedgerClosed method documentation.
 */
class LedgerClosed extends AbstractMethod
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
        $this->addField(new Field([
            'name' => 'ledger_hash',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ledger_index',
            'required' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
