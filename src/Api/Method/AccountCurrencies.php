<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * AccountCurrencies Method Class
 *
 * The account_currencies command retrieves a list of currencies that an account can send or receive, based on its trust
 * lines. (This is not a thoroughly confirmed list, but it can be used to populate user interfaces.)
 *
 * @link https://developers.ripple.com/account_currencies.html AccountCurrencies method documentation.
 */
class AccountCurrencies extends AbstractMethod
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

        // END GENERATED
    }
}
