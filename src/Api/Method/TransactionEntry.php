<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * TransactionEntry Method Class
 *
 * The transaction_entry method retrieves information on a single transaction from a specific ledger version. (The tx
 * method, by contrast, searches all ledgers for the specified transaction. We recommend using that method instead.)
 *
 * https://developers.ripple.com/transaction_entry.html TransactionEntry method documentation.
 */
class TransactionEntry extends AbstractMethod
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
            'name' => 'tx_hash',
            'required' => false
        ]));

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
