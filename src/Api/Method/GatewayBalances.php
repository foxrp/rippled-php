<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * GatewayBalances Method Class
 *
 * The gateway_balances command calculates the total balances issued by a given account, optionally excluding amounts
 * held by operational addresses.
 *
 * @link https://developers.ripple.com/gateway_balances.html GatewayBalances method documentation.
 */
class GatewayBalances extends AbstractMethod
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
            'name' => 'hotwallet',
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
