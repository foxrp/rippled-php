<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * AccountObjects Method Class
 *
 * The account_objects command returns the raw ledger format for all objects owned by an account. For a higher-level
 * view of an account's trust lines and balances, see the account_lines method instead.
 *
 * @link https://developers.ripple.com/account_objects.html AccountObjects method documentation.
 */
class AccountObjects extends AbstractMethod
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

    }
}
