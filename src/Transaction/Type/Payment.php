<?php

namespace XRPHP\Transaction\Type;

use XRPhp\Transaction\Field;

/**
 * A Payment transaction represents a transfer of value from one account to another. (Depending on the path taken, this
 * can involve additional exchanges of value, which occur atomically.)
 *
 * @link https://developers.ripple.com/payment.html Payment transaction type documentation.
 * @package XRPHP\TransactionType
 */
class Payment extends AbstractType
{
    public function __construct()
    {
        parent::__construct();

        $this->addField(new Field([
            'name' => 'Amount',
            'description' => 'The amount of currency to deliver.',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'Destination',
            'description' => 'The unique address of the account receiving the payment.',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'DestinationTag',
            'description' => 'Arbitrary tag that identifies the reason for the payment to the destination, or a hosted recipient to pay.',
            'jsonType' => 'Unsigned Integer'
        ]));

        $this->addField(new Field([
            'name' => 'InvoiceId',
            'description' => 'Arbitrary 256-bit hash representing a specific reason or identifier for this payment.',
            'jsonType' => 'String'
        ]));

        $this->addField(new Field([
            'name' => 'Paths',
            'description' => 'Array of payment paths to be used for this transaction. Must be omitted for XRP-to-XRP transactions.',
            'jsonType' => 'Array'
        ]));

        $this->addField(new Field([
            'name' => 'SendMax',
            'description' => 'Highest amount of source currency this transaction is allowed to cost, including transfer fees, exchange rates, and slippage.',
            'jsonType' => 'Currency Amount'
        ]));

        $this->addField(new Field([
            'name' => 'DeliverMin',
            'description' => 'Minimum amount of destination currency this transaction should deliver. Only valid if this is a partial payment. For non-XRP amounts, the nested field names are lower-case.',
            'jsonType' => 'Currency Amount'
        ]));
    }
}
