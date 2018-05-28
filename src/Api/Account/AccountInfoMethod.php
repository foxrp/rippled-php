<?php

namespace XRPHP\Api\Account;

use XRPHP\Api\Method;

class AccountInfoMethod extends Method
{
    public function getValidParameters(): array
    {
        return [
            'account',
            'strict',
            'ledger_hash',
            'ledger_index',
            'queue',
            'signer_lists'
        ];
    }

    /**
     * Validates parameters.
     *
     * @param array|null $params
     * @throws \BadMethodCallException
     */
    public function validateParameters(array $params = null): void
    {
        if (!isset($params['account'])) {
            throw new \BadMethodCallException('Missing parameter: account');
        }
    }
}
