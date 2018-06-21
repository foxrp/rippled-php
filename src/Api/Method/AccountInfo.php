<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * AccountInfo Method Class
 *
 * The account_info command retrieves information about an account, its activity, and its XRP balance. All information
 * retrieved is relative to a particular version of the ledger.
 *
 * https://developers.ripple.com/account_info.html AccountInfo method documentation.
 */
class AccountInfo extends AbstractMethod
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
            'name' => 'strict',
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
            'name' => 'queue',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'signer_lists',
            'required' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
