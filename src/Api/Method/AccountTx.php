<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;
use XRPHP\Exception\InvalidParameterException;

/**
 * AccountTx Method Class
 *
 * The account_tx method retrieves a list of transactions that involved the specified account.
 *
 * https://developers.ripple.com/account_offers.html AccountTx method documentation.
 */
class AccountTx extends AbstractMethod
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
            'name' => 'ledger_index_min',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ledger_index_max',
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
            'name' => 'forward',
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

    /**
     * @param array $params
     * @throws InvalidParameterException
     */
    public function validateParams(array $params): void
    {
        parent::validateParams($params);

        if (!isset($params['ledger_index_min'])
            && !isset($params['ledger_index_max'])
            && !isset($params['ledger_hash'])
            && !isset($params['ledger_index'])
        ) {
            throw new InvalidParameterException('At least one of the following parameters must be used: ledger_index, ledger_hash, ledger_index_min, ledger_index_max');
        }
    }
}
