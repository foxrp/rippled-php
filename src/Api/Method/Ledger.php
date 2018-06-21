<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * Ledger Method Class
 *
 * Retrieve information about the public ledger.
 *
 * https://developers.ripple.com/ledger.html Ledger method documentation.
 */
class Ledger extends AbstractMethod
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

        $this->addField(new Field([
            'name' => 'full',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'accounts',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'transactions',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'expand',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'owner_funds',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'binary',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'queue',
            'required' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
