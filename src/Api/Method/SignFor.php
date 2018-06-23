<?php declare(strict_types=1);

namespace FOXRP\Rippled\Api\Method;

use FOXRP\Rippled\Api\Field;
use FOXRP\Rippled\Exception\InvalidParameterException;

/**
 * SignFor Method Class
 *
 * The address which is providing the signature.
 *
 * @link https://developers.ripple.com/sign_for.html SignFor method documentation.
 */
class SignFor extends AbstractMethod
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
            'name' => 'account',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'tx_json',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'secret',
            'required' => false
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

        $this->addField(new Field([
            'name' => 'key_type',
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

        $this->validateSignParameters($params);
    }
}
