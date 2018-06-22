<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;
use XRPHP\Exception\InvalidParameterException;

/**
 * AccountTx Method Class
 *
 * The account_tx method retrieves a list of transactions that involved the specified account.
 *
 * @link https://developers.ripple.com/account_offers.html AccountTx method documentation.
 */
class AccountTx extends AbstractMethod
{
    /**
     * {@inheritDoc}
     *
     * @throws \XRPHP\Exception\FieldException
     */
    public function setFields(): void
    {
        parent::setFields();

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
