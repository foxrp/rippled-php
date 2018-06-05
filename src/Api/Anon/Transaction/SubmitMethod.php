<?php

namespace XRPHP\Api\Anon\Transaction;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The submit method applies a transaction and sends it to the network to be confirmed and included in future ledgers.
 *
 * @link https://developers.ripple.com/submit.html Documentation of submit.
 * @package XRPHP\Api\Transaction
 */
class SubmitMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'tx_blob',
            'fail_hard',
            'tx_json',
            'secret',
            'seed',
            'seed_hex',
            'passphrase',
            'key_type',
            'fail_hard',
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
        if (!isset($params['tx_json']) && !isset($params['tx_blob'])) {
            throw new InvalidParameterException('Missing parameter: tx_blob or tx_json');
        }

        // When using sign-and-submit mode, validate signing params.
        if (isset($params['tx_json'])) {
            $this->validateSignParameters($params);
        }
    }
}
