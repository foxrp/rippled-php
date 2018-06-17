<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Transaction\TypeField;

/**
 * A Payment transaction represents a transfer of value from one account to another. (Depending on the path taken, this
 * can involve additional exchanges of value, which occur atomically.)
 *
 * @link https://developers.ripple.com/payment.html Payment transaction type documentation.
 * @package XRPHP\TransactionType
 */
class AccountSet extends AbstractType
{
    /**
     * AccountSet constructor.
     * @param array|null $params
     * @throws \XRPHP\Exception\InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        $this->addField(new TypeField([
            'name' => 'ClearFlag',
            'description' => 'Unique identifier of a flag to disable for this account.',
            'jsonType' => 'Unsigned Integer'
        ]));

        $this->addField(new TypeField([
            'name' => 'Domain',
            'description' => 'Optional) The domain that owns this account, as a string of hex representing the ASCII for the domain in lowercase.',
            'jsonType' => 'String'
        ]));

        $this->addField(new TypeField([
            'name' => 'EmailHash',
            'description' => 'Hash of an email address to be used for generating an avatar image. Conventionally, clients use Gravatar to display this image.',
            'jsonType' => 'String'
        ]));

        $this->addField(new TypeField([
            'name' => 'MessageKey',
            'description' => 'Public key for sending encrypted messages to this account.',
            'jsonType' => 'String'
        ]));

        $this->addField(new TypeField([
            'name' => 'SetFlag',
            'description' => 'Integer flag to enable for this account.',
            'jsonType' => 'Unsigned Integer'
        ]));

        $this->addField(new TypeField([
            'name' => 'TransferRate',
            'description' => 'The fee to charge when users transfer this account\'s issued currencies, represented as billionths of a unit. Cannot be more than 2000000000 or less than 1000000000, except for the special case 0 meaning no fee.',
            'jsonType' => 'Unsigned Integer'
        ]));

        $this->addField(new TypeField([
            'name' => 'TickSize',
            'description' => 'Tick size to use for offers involving a currency issued by this address. The exchange rates of those offers is rounded to this many significant digits. Valid values are 3 to 15 inclusive, or 0 to disable. (Requires the TickSize amendment.)',
            'jsonType' => 'Unsigned Integer'
        ]));

        $this->addField(new TypeField([
            'name' => 'WalletLocator',
            'description' => 'Not used.',
            'jsonType' => 'String'
        ]));

        $this->addField(new TypeField([
            'name' => 'WalletSize',
            'description' => 'Not used.',
            'jsonType' => 'Unsigned Integer'
        ]));

        parent::__construct($params);
    }
}
