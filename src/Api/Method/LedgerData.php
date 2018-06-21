<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * LedgerData Method Class
 *
 * The ledger_data method retrieves contents of the specified ledger. You can iterate through several calls to retrieve
 * the entire contents of a single ledger version.
 *
 * https://developers.ripple.com/ledger_data.html LedgerData method documentation.
 */
class LedgerData extends AbstractMethod
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
            'name' => 'id',
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

        $this->addField(new Field([
            'name' => 'binary',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'limit',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'marker',
            'required' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
