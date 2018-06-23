<?php declare(strict_types=1);

namespace FOXRP\Rippled\Api\Method;

use FOXRP\Rippled\Api\Field;

/**
 * NorippleCheck Method Class
 *
 * The noripple_check command provides a quick way to check the status of the DefaultRipple field for an account and the
 * NoRipple flag of its trust lines, compared with the recommended settings.
 *
 * @link https://developers.ripple.com/noripple_check.html NorippleCheck method documentation.
 */
class NorippleCheck extends AbstractMethod
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
            'name' => 'role',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'transactions',
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
