<?php

namespace XRPHP\Api\Anon\PathOrderBook;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The book_offers method retrieves a list of offers, also known as the order book, between two currencies. If the
 * results are very large, a partial result is returned with a marker so that later requests can resume from where the
 * previous one left off.
 *
 * @link https://developers.ripple.com/ripple_path_find.html Documentation of ripple_path_find.
 * @package XRPHP\Api\PathOrderBook
 */
class RipplePathFindMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'source_account',
            'destination_account',
            'destination_amount',
            'send_max',
            'source_currencies',
            'ledger_hash',
            'ledger_index',
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
        if (!isset($params['source_account'])) {
            throw new InvalidParameterException('Missing parameter: source_account');
        }

        if (!isset($params['destination_account'])) {
            throw new InvalidParameterException('Missing parameter: destination_account');
        }

        if (!isset($params['destination_amount'])) {
            throw new InvalidParameterException('Missing parameter: destination_amount');
        }
    }
}
