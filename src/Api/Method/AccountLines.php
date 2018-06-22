<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * AccountLines Method Class
 *
 * The account_lines method returns information about an account's trust lines, including balances in all non-XRP
 * currencies and assets. All information retrieved is relative to a particular version of the ledger.
 *
 * @link https://developers.ripple.com/account_lines.html AccountLines method documentation.
 */
class AccountLines extends AbstractMethod
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
            'name' => 'peer',
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
