<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\AbstractFieldable;
use XRPHP\Exception\InvalidParameterException;

abstract class AbstractMethod extends AbstractFieldable
{
    /**
     * Validates common parameters used among transaction signing methods.
     *
     * @param array $params
     * @throws InvalidParameterException
     */
    public function validateSignParameters(array $params): void
    {
        if (!isset($params['tx_json'])) {
            throw new InvalidParameterException('Missing parameter: tx_json');
        }

        if (isset($params['secret'])) {
            if (
                isset($params['key_type'])
                || isset($params['seed'])
                || isset($params['seed_hex'])
                || isset($params['passphrase'])
            ) {
                throw new InvalidParameterException('Parameters key_type, seed, seed_hex, or passphrase cannot be used with secret');
            }
        }

        if (isset($params['seed'])) {
            if (!isset($params['key_type'])) {
                throw new InvalidParameterException('key_type must be provided when using seed');
            }
            if (
                isset($params['secret'])
                || isset($params['seed_hex'])
                || isset($params['passphrase'])
            ) {
                throw new InvalidParameterException('Parameters secret, seed_hex, or passphrase cannot be used with seed');
            }
        }

        if (isset($params['seed_hex'])) {
            if (!isset($params['key_type'])) {
                throw new InvalidParameterException('key_type must be provided when using seed_hex');
            }
            if (
                isset($params['secret'])
                || isset($params['seed'])
                || isset($params['passphrase'])
            ) {
                throw new InvalidParameterException('Parameters secret, seed, or passphrase cannot be used with seed_hex');
            }
        }

        if (isset($params['passphrase'])) {
            if (!isset($params['key_type'])) {
                throw new InvalidParameterException('key_type must be provided when using passphrase');
            }
        }
    }
}
