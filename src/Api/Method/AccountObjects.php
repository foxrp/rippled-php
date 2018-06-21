<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * AccountObjects Method Class
 *
 * The account_objects command returns the raw ledger format for all objects owned by an account. For a higher-level
 * view of an account's trust lines and balances, see the account_lines method instead.
 *
 * https://developers.ripple.com/account_objects.html AccountObjects method documentation.
 */
class AccountObjects extends AbstractMethod
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
            'name' => 'account',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'type',
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
