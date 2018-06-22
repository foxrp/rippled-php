<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * SetRegularKey Transaction Type Class
 *
 * A SetRegularKey transaction assigns, changes, or removes the regular key pair associated with an account.\n\nYou can
 * protect your account by assigning a regular key pair to it and using it instead of the master key pair to sign
 * transactions whenever possible. If your regular key pair is compromised, but your master key pair is not, you can use
 * a SetRegularKey transaction to regain control of your account.
 *
 * @link https://developers.ripple.com/setregularkey.html SetRegularKey transaction type documentation.
 */
class SetRegularKey extends AbstractTransactionType
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
            'name' => 'RegularKey',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED
    }
}
