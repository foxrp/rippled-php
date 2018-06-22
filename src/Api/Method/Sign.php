<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * Sign Method Class
 *
 * The sign method takes a transaction in JSON format and a secret key, and returns a signed binary representation of
 * the transaction. The result is always different, even when you provide the same transaction JSON and secret key. To
 * contribute one signature to a multi-signed transaction, use the sign_for method instead.
 *
 * @link https://developers.ripple.com/sign.html Sign method documentation.
 */
class Sign extends AbstractMethod
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
            'name' => 'tx_json',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'secret',
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

        $this->addField(new Field([
            'name' => 'passphrase',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'key_type',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'offline',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'build_path',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'fee_mult_max',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'fee_div_max',
            'required' => false
        ]));

        // END GENERATED
    }
}
