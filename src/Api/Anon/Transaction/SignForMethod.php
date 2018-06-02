<?php

namespace XRPHP\Api\Anon\Transaction;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The sign_for command provides one signature for a multi-signed transaction.
 *
 * @link https://developers.ripple.com/sign_for.html Documentation of sign_for.
 * @package XRPHP\Api\Transaction
 */
class SignForMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'tx_json',
            'secret',
            'passphrase',
            'seed',
            'seed_hex',
            'key_type'
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
        if (!isset($params['account'])) {
            throw new InvalidParameterException('Missing parameter: account');
        }

        $this->validateSignParameters($params);
    }
}
