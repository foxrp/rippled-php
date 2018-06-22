<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * SignerListSet Transaction Type Class
 *
 * The SignerListSet transaction creates, replaces, or removes a list of signers that can be used to multi-sign a
 * transaction.
 *
 * @link https://developers.ripple.com/signerlistset.html SignerListSet transaction type documentation.
 */
class SignerListSet extends AbstractTransactionType
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
            'name' => 'SignerQuorum',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'SignerEntries',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED
    }
}
