<?php

namespace XRPHP\Api\Anon\Transaction;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The sign method takes a transaction in JSON format and a secret key, and returns a signed binary representation of
 * the transaction. The result is always different, even when you provide the same transaction JSON and secret key. To
 * contribute one signature to a multi-signed transaction, use the sign_for method instead.
 *
 * @link https://developers.ripple.com/sign.html#main_content_body Documentation of sign.
 * @package XRPHP\Api\Transaction
 */
class SignMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'tx_json',
            'secret',
            'seed',
            'seed_hex',
            'passphrase',
            'key_type',
            'offline',
            'build_path',
            'fee_mult_max',
            'fee_div_max'
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
        if (!isset($params['tx_json'])) {
            throw new InvalidParameterException('Missing parameter: tx_json');
        }

        $this->validateSignParameters($params);
    }
}
