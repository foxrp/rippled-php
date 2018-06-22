<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * BookOffers Method Class
 *
 * The book_offers method retrieves a list of offers, also known as the order book, between two currencies. If the
 * results are very large, a partial result is returned with a marker so that later requests can resume from where the
 * previous one left off.
 *
 * https://developers.ripple.com/book_offers.html BookOffers method documentation.
 */
class BookOffers extends AbstractMethod
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
            'name' => 'taker_gets',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'taker_pays',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'taker',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ledger_hash',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ledger_index',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'marker',
            'required' => false
        ]));

        // END GENERATED

        parent::__construct($params);
    }
}
