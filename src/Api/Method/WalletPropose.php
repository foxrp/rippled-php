<?php declare(strict_types=1);

namespace FOXRP\Rippled\Api\Method;

use FOXRP\Rippled\Api\Field;

/**
 * WalletPropose Method Class
 *
 * Use the wallet_propose method to generate a key pair and XRP Ledger address.
 *
 * @link https://xrpl.org/wallet_propose.html WalletPropose method documentation.
 */
class WalletPropose extends AbstractMethod
{
    /**
     * {@inheritDoc}
     *
     * @throws \FOXRP\Rippled\Exception\FieldException
     */
    public function setFields(): void
    {
        parent::setFields();

        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new Field([
            'name' => 'key_type',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'passphrase',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'seed',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'seed_hex',
            'required' => false
        ]));

        // END GENERATED
    }
}
