<?php

namespace XRPHP\Api\Anon\Transaction;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The tx method retrieves information on a single transaction.
 *
 * @link https://developers.ripple.com/tx.html Documentation of transaction_entry.
 * @package XRPHP\Api\Transaction
 */
class TxMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'transaction',
            'binary'
        ];
    }

    /**
     * Validates parameters.
     *
     * @param array|null $params
     * @throws InvalidParameterException
     */
    public function validateParameters(array $params = null): void
    {
        if (!isset($params['transaction'])) {
            throw new InvalidParameterException('Missing parameter: transaction');
        }
    }
}
