<?php

namespace XRPHP\Api\Anon\Ledger;

use XRPHP\Api\Method;
use XRPHP\Exception\InvalidParameterException;

/**
 * The ledger_entry method returns a single ledger object from the XRP Ledger in its raw format.
 *
 * @link https://developers.ripple.com/ledger_entry.html Documentation of ledger_entry.
 * @package XRPHP\Api\Anon\Ledger
 */
class LedgerEntryMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'index',
            'account_root',
            'directory',
            'directory.sub_index',
            'directory.dir_root',
            'directory.owner',
            'offer',
            'offer.account',
            'offer.seq',
            'ripple_state',
            'ripple_state.accounts',
            'ripple_state.currency',
            'binary',
            'ledger_hash',
            'ledger_index'
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
