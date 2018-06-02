<?php

namespace XRPHP\Api\Anon\Transaction;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The submit_multisigned command applies a multi-signed transaction and sends it to the network to be included in
 * future ledgers. (You can also submit multi-signed transactions in binary form using the submit command in
 * submit-only mode.)
 *
 * @link https://developers.ripple.com/submit_multisigned.html Documentation of submit_multisigned.
 * @package XRPHP\Api\Transaction
 */
class SubmitMultisignedMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'tx_json',
            'fail_hard'
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
    }
}
