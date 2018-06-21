<?php

namespace XRPHP\Api\Method;

use XRPHP\Api\Field;
use XRPHP\Exception\InvalidParameterException;

/**
 * LedgerEntry Method Class
 *
 * The ledger_entry method returns a single ledger object from the XRP Ledger in its raw format. See ledger format for
 * information on the different types of objects you can retrieve.
 *
 * https://developers.ripple.com/ledger_entry.html LedgerEntry method documentation.
 */
class LedgerEntry extends AbstractMethod
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
            'name' => 'index',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'account_root',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'check',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'directory',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'directory.sub_index',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'directory.dir_root',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'directory.owner',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'escrow',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'escrow.owner',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'escrow.seq',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'offer',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'offer.account',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'offer.seq',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'payment_channel',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ripple_state',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ripple_state.accounts',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'ripple_state.currency',
            'required' => false
        ]));

        $this->addField(new Field([
            'name' => 'binary',
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

        // END GENERATED

        parent::__construct($params);
    }

    public function validateParams(array $params): void
    {
        // directory.dir_root or directory.owner is required when directory is supplied.
        if (isset($params['directory'])
            && !isset($params['directory.dir_root'])
            && !isset($params['directory.owner'])) {
            throw new InvalidParameterException('Missing parameter: directory.owner or directory.dir_root');
        }

        // offer.account and offer.seq is required when offer is supplied.
        if (isset($params['offer'])) {
            if (!isset($params['offer.account'])) {
                throw new InvalidParameterException('Missing parameter: offer.account');
            }
            if (!isset($params['offer.seq'])) {
                throw new InvalidParameterException('Missing parameter: offer.seq');
            }
        }

        // ripple_state.accounts and ripple_state.currency is required when ripple_state is supplied.
        if (isset($params['ripple_state'])) {
            if (!isset($params['ripple_state.accounts'])) {
                throw new InvalidParameterException('Missing parameter: ripple_state.accounts');
            }
            if (!isset($params['ripple_state.currency'])) {
                throw new InvalidParameterException('Missing parameter: ripple_state.currency');
            }
        }
    }
}
