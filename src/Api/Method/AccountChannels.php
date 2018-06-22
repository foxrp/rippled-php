<?php declare(strict_types=1);

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;

/**
 * AccountChannels Method Class
 *
 * The account_channels method returns information about an account's Payment Channels. This includes only channels
 * where the specified account is the channel's source, not the destination. (A channel's "source" and "owner" are the
 * same.) All information retrieved is relative to a particular version of the ledger.
 *
 * @link https://developers.ripple.com/account_channels.html AccountChannels method documentation.
 */
class AccountChannels extends AbstractMethod
{
    /**
     * {@inheritDoc}
     *
     * @throws \XRPHP\Exception\FieldException
     */
    public function setFields(): void
    {
        parent::setFields();

        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new Field([
            'name' => 'account',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'destination_account',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ledger_hash',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'ledger_index',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'limit',
            'required' => true
        ]));

        $this->addField(new Field([
            'name' => 'marker',
            'required' => true
        ]));

        // END GENERATED

    }
}
