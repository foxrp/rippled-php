<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * SignerListSet Transaction Type Class
 *
 * The SignerListSet transaction creates, replaces, or removes a list of signers that can be used to multi-sign a
 * transaction.
 *
 * https://developers.ripple.com/signerlistset.html SignerListSet transaction type documentation.
 */
class SignerListSet extends AbstractType
{
    /**
     * SignerListSet constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'SignerQuorum',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'SignerEntries',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
