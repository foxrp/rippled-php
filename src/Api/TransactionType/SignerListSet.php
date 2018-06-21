<?php

namespace XRPHP\Api\TransactionType;

use XRPHP\Api\Field;

/**
 * SignerListSet Transaction Type Class
 *
 * The SignerListSet transaction creates, replaces, or removes a list of signers that can be used to multi-sign a
 * transaction.
 *
 * https://developers.ripple.com/signerlistset.html SignerListSet transaction type documentation.
 */
class SignerListSet extends AbstractTransactionType
{
    /**
     * Constructor
     *
     * @param array|null $params Array of parameters to validate.
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
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

        parent::__construct($params);
    }
}
