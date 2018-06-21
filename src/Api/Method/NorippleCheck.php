<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * NorippleCheck Method Class
 *
 * The noripple_check command provides a quick way to check the status of the DefaultRipple field for an account and the
 * NoRipple flag of its trust lines, compared with the recommended settings.
 *
 * https://developers.ripple.com/noripple_check.html NorippleCheck method documentation.
 */
class NorippleCheck extends AbstractMethod
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
            'name' => 'role',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'transactions',
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
