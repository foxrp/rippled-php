<?php

namespace XRPHP\Api\Anon\PathOrderBook;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The book_offers method retrieves a list of offers, also known as the order book, between two currencies. If the
 * results are very large, a partial result is returned with a marker so that later requests can resume from where the
 * previous one left off.
 *
 * @link https://developers.ripple.com/book_offers.html Documentation of book_offers.
 * @package XRPHP\Api\PathOrderBook
 */
class BookOffersMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'ledger_hash',
            'ledger_index',
            'limit',
            'marker',
            'taker',
            'taker_gets',
            'taker_pays'
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
        if (!isset($params['taker_gets'])) {
            throw new InvalidParameterException('Missing parameter: taker_gets');
        }

        if (!isset($params['taker_pays'])) {
            throw new InvalidParameterException('Missing parameter: taker_pays');
        }
    }
}
