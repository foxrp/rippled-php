<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * TrustSet Transaction Type Class
 *
 * Create or modify a trust line linking two accounts.
 *
 * https://developers.ripple.com/trustset.html TrustSet transaction type documentation.
 */
class TrustSet extends AbstractType
{
    /**
     * TrustSet constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'LimitAmount',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'LimitAmount.currency',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'LimitAmount.value',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'LimitAmount.issuer',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'QualityIn',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'QualityOut',
            'required' => true,
            'autoFillable' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
