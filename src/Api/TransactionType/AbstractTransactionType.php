<?php

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\AbstractFieldable;
use XRPHP\Api\Field;

/**
 * Class AbstractTransactionType is extended with classes for each individual Transaction Type.
 */
abstract class AbstractTransactionType extends AbstractFieldable
{

    public function setFields(): void
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new Field([
            'name' => 'Account',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'TransactionType',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'Fee',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'Sequence',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'AccountTxnID',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'Flags',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'LastLedgerSequence',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'Memos',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'Signers',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'SourceTag',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'SigningPubKey',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'TxnSignature',
            'required' => false
        ]));

        // END GENERATED
    }

}
