<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * AccountSet Transaction Type Class
 *
 * An AccountSet transaction modifies the properties of an account in the XRP Ledger.
 *
 * https://developers.ripple.com/accountset.html AccountSet transaction type documentation.
 */
class AccountSet extends AbstractType
{
    /**
     * AccountSet constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'ClearFlag',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Domain',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'EmailHash',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'MessageKey',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'SetFlag',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'TransferRate',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'TickSize',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'WalletLocator',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'TickSize',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
