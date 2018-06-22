<?php declare(strict_types=1);

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\AbstractFieldable;
use XRPHP\Api\Field;
use XRPHP\Api\FieldableInterface;

/**
 * Provides an abstract for defining and transaction types and validating its fields.
 */
abstract class AbstractTransactionType extends AbstractFieldable implements FieldableInterface
{
    /**
     * @throws \XRPHP\Exception\FieldException
     */
    public function setFields(): void
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new Field([
            'name' => 'Account',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'TransactionType',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Fee',
            'required' => false,
            'autoFillable' => true
        ]));

        $this->addField(new Field([
            'name' => 'Sequence',
            'required' => false,
            'autoFillable' => true
        ]));

        $this->addField(new Field([
            'name' => 'AccountTxnID',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Flags',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'LastLedgerSequence',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Memos',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'Signers',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'SourceTag',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'SigningPubKey',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new Field([
            'name' => 'TxnSignature',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED
    }
}
