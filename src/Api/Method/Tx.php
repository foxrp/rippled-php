<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * Tx Method Class
 *
 * The tx method retrieves information on a single transaction.
 *
 * https://developers.ripple.com/tx.html Tx method documentation.
 */
class Tx extends AbstractMethod
{
    /**
     * Constructor.
     *
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new Field([
            'name' => 'transaction',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'binary',
            'required' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
