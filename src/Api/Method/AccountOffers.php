<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * AccountOffers Method Class
 *
 * The account_offers method retrieves a list of offers made by a given account that are outstanding as of a particular
 * ledger version.
 *
 * @link https://developers.ripple.com/account_offers.html AccountOffers method documentation.
 */
class AccountOffers extends AbstractMethod
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
