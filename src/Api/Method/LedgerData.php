<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * LedgerData Method Class
 *
 * The ledger_data method retrieves contents of the specified ledger. You can iterate through several calls to retrieve
 * the entire contents of a single ledger version.
 *
 * @link https://developers.ripple.com/ledger_data.html LedgerData method documentation.
 */
class LedgerData extends AbstractMethod
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
            'name' => 'id',
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

        $this->addField(new Field([
            'name' => 'binary',
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
