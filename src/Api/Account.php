<?php

namespace XRPHP\Api;

class Account extends AbstractApi
{
    /**
     * @param string $account                   The account id.
     * @param string|null $destination_account  The unique identifier of an account, typically the account's Address. If provided, filter results to payment channels whose destination is this account.
     * @param string|null $ledger_hash          A 20-byte hex string for the ledger version to use.
     * @param string|null $ledger_index         The sequence number of the ledger to use, or a shortcut string to choose a ledger automatically.
     * @param int|null $limit                   Limit the number of transactions to retrieve. The server is not required to honor this value. Must be within the inclusive range 10 to 400. Defaults to 200.
     * @param string|null $marker               Value from a previous paginated response. Resume retrieving data where that response left off.
     * @return array|string
     */
    public function channels(
        string $account,
        string $destination_account = null,
        string $ledger_hash = null,
        string $ledger_index = null,
        int $limit = null,
        string $marker = null
    )
    {
        $params = ['account' => $account];

        if ($destination_account !== null) { $params['destination_account'] = $destination_account; }
        if ($ledger_hash !== null) { $params['ledger_hash'] = $ledger_hash; }
        if ($ledger_index !== null) { $params['ledger_index'] = $ledger_index; }
        if ($limit !== null) { $params['limit'] = $limit; }
        if ($marker !== null) { $params['marker'] = $marker; }

        return $this->post('account_channels', $params);
    }

    /**
     * @param string        $account        The account id.
     * @param bool|null     $strict         If true, only accept an address or public key for the account parameter. Defaults to false.
     * @param string|null   $ledger_hash    A 20-byte hex string for the ledger version to use.
     * @param string|null   $ledger_index   The sequence number of the ledger to use, or a shortcut string to choose a ledger automatically.
     * @return array|string
     */
    public function currencies(
        string $account,
        bool $strict = null,
        string $ledger_hash = null,
        $ledger_index = null
    )
    {
        $params = ['account' => $account, 'strict' => $strict];

        if ($strict !== null) { $params['strict'] = $strict; }
        if ($ledger_hash !== null) { $params['ledger_hash'] = $ledger_hash; }
        if ($ledger_index !== null) { $params['ledger_index'] = $ledger_index; }

        return $this->post('account_currencies', $params);
    }

    /**
     * @param string        $account        The account id.
     * @param bool|null     $strict         If set true, then account field only accepts a public key or XRP Ledger address.
     * @param string|null   $ledger_hash    A 20-byte hex string for the ledger version to use.
     * @param string|null   $ledger_index   The sequence number of the ledger to use, or a shortcut string to choose a ledger automatically.
     * @param bool|null     $queue          If true, the FeeEscalation amendment is enabled, also returns stats about queued transactions.
     * @param bool|null     $signer_lists   If true, the MultiSign amendment is enabled, also returns any SignerList objects associated with this account.
     *
     * @return array|string
     */
    public function info(
        string $account,
        bool $strict = false,
        string $ledger_hash = null,
        $ledger_index = null,
        bool $queue = null,
        bool $signer_lists = null
    )
    {
        $params = ['account' => $account, 'strict' => $strict];

        if ($strict !== null) { $params['strict'] = $strict; }
        if ($ledger_hash !== null) { $params['ledger_hash'] = $ledger_hash; }
        if ($ledger_index !== null) { $params['ledger_index'] = $ledger_index; }
        if ($queue !== null) { $params['queue'] = $queue; }
        if ($signer_lists !== null) { $params['signer_lists'] = $signer_lists; }

        return $this->post('account_info', $params);
    }

    /**
     * @param string $account           The account id.
     * @param string|null $ledger_hash  A 20-byte hex string for the ledger version to use.
     * @param string|null $ledger_index The sequence number of the ledger to use, or a shortcut string to choose a ledger automatically.
     * @param string|null $peer         The Address of a second account. If provided, show only lines of trust connecting the two accounts.
     * @param int|null $limit           Limit the number of transactions to retrieve. The server is not required to honor this value. Must be within the inclusive range 10 to 400. Defaults to 200.
     * @param string|null $marker       Value from a previous paginated response. Resume retrieving data where that response left off.
     * @return array|string
     */
    public function lines(
        string $account,
        string $ledger_hash = null,
        string $ledger_index = null,
        string $peer = null,
        int $limit = null,
        string $marker = null
    )
    {
        $params = ['account' => $account];

        if ($ledger_hash !== null) { $params['ledger_hash'] = $ledger_hash; }
        if ($ledger_index !== null) { $params['ledger_index'] = $ledger_index; }
        if ($peer !== null) { $params['peer'] = $peer; }
        if ($limit !== null) { $params['limit'] = $limit; }
        if ($marker !== null) { $params['marker'] = $marker; }

        return $this->post('account_lines', $params);
    }

    /**
     * @param string $account           The account id.
     * @param string|null $ledger_hash  A 20-byte hex string for the ledger version to use.
     * @param string|null $ledger_index The sequence number of the ledger to use, or a shortcut string to choose a ledger automatically.
     * @param int|null $limit           Limit the number of transactions to retrieve. The server is not required to honor this value. Must be within the inclusive range 10 to 400. Defaults to 200.
     * @param string|null $marker       Value from a previous paginated response. Resume retrieving data where that response left off.
     * @return array|string
     */
    public function objects(
        string $account,
        string $ledger_hash = null,
        string $ledger_index = null,
        int $limit = null,
        string $marker = null
    )
    {
        $params = ['account' => $account];

        if ($ledger_hash !== null) { $params['ledger_hash'] = $ledger_hash; }
        if ($ledger_index !== null) { $params['ledger_index'] = $ledger_index; }
        if ($limit !== null) { $params['limit'] = $limit; }
        if ($marker !== null) { $params['marker'] = $marker; }

        return $this->post('account_objects', $params);
    }

    /**
     * @param string $account           The account id.
     * @param string|null $ledger_hash  A 20-byte hex string for the ledger version to use.
     * @param string|null $ledger_index The sequence number of the ledger to use, or a shortcut string to choose a ledger automatically.
     * @param int|null $limit           Limit the number of transactions to retrieve. The server is not required to honor this value. Must be within the inclusive range 10 to 400. Defaults to 200.
     * @param string|null $marker       Value from a previous paginated response. Resume retrieving data where that response left off.
     * @return array|string
     */
    public function offers(
        string $account,
        string $ledger_hash = null,
        string $ledger_index = null,
        int $limit = null,
        string $marker = null
    )
    {
        $params = ['account' => $account];

        if ($ledger_hash !== null) { $params['ledger_hash'] = $ledger_hash; }
        if ($ledger_index !== null) { $params['ledger_index'] = $ledger_index; }
        if ($limit !== null) { $params['limit'] = $limit; }
        if ($marker !== null) { $params['marker'] = $marker; }

        return $this->post('account_offers', $params);
    }

    /**
     * @param string $account           The account id.
     * @param int|null $ledger_min      Use to specify the earliest ledger to include transactions from. A value of -1 instructs the server to use the earliest validated ledger version available.
     * @param int|null $ledger_max      Use to specify the most recent ledger to include transactions from. A value of -1 instructs the server to use the most recent validated ledger version available.
     * @param string|null $ledger_hash  A 20-byte hex string for the ledger version to use.
     * @param string|null $ledger_index The sequence number of the ledger to use, or a shortcut string to choose a ledger automatically.
     * @param bool|null $binary         Defaults to false. If set to true, returns transactions as hex strings instead of JSON.
     * @param bool|null $forward        Defaults to false. If set to true, returns values indexed with the oldest ledger first. Otherwise, the results are indexed with the newest ledger first.
     * @param int|null $limit           Limit the number of transactions to retrieve. The server is not required to honor this value. Must be within the inclusive range 10 to 400. Defaults to 200.
     * @param string|null $marker       Value from a previous paginated response. Resume retrieving data where that response left off.
     * @return array|string
     */
    public function tx(
        string $account,
        int $ledger_min = null,
        int $ledger_max = null,
        string $ledger_hash = null,
        string $ledger_index = null,
        bool $binary = null,
        bool $forward = null,
        int $limit = null,
        string $marker = null
    )
    {
        $params = ['account' => $account];

        if ($ledger_min !== null) { $params['ledger_min'] = $ledger_min; }
        if ($ledger_max !== null) { $params['ledger_max'] = $ledger_max; }
        if ($ledger_hash !== null) { $params['ledger_hash'] = $ledger_hash; }
        if ($ledger_index !== null) { $params['ledger_index'] = $ledger_index; }
        if ($binary !== null) { $params['binary'] = $binary; }
        if ($forward !== null) { $params['forward'] = $forward; }
        if ($limit !== null) { $params['limit'] = $limit; }
        if ($marker !== null) { $params['marker'] = $marker; }

        return $this->post('account_tx', $params);
    }

    /**
     * @param string $account               The account id.
     * @param bool|null $strict             If set true, then account field only accepts a public key or XRP Ledger address.
     * @param string|array|null $hotwallet  An operational address to exclude from the balances issued, or an array of such addresses.
     * @param string|null $ledger_hash      A 20-byte hex string for the ledger version to use.
     * @param string|null $ledger_index     The sequence number of the ledger to use, or a shortcut string to choose a ledger automatically.
     * @return array|string
     */
    public function gatewayBalances(
        string $account,
        bool $strict = null,
        $hotwallet = null,
        string $ledger_hash = null,
        string $ledger_index = null
    )
    {
        $params = ['account' => $account];

        if ($strict !== null) { $params['strict'] = $strict; }
        if ($hotwallet !== null) { $params['hotwallet'] = $hotwallet; }
        if ($ledger_hash !== null) { $params['ledger_hash'] = $ledger_hash; }
        if ($ledger_index !== null) { $params['ledger_index'] = $ledger_index; }

        return $this->post('gateway_balances', $params);
    }

    /**
     * @param string $account               The account id.
     * @param string $role                  Whether the address refers to a gateway or user.
     * @param bool|null $transactions       If true, include an array of suggested transactions, as JSON objects, that you can sign and submit to fix the problems. Defaults to false.
     * @param int|null $limit               The maximum number of trust line problems to include in the results. Defaults to 300.
     * @param string|null $ledger_hash      A 20-byte hex string for the ledger version to use.
     * @param string|null $ledger_index     The sequence number of the ledger to use, or a shortcut string to choose a ledger automatically.
     * @return array|string
     */
    public function norippleCheck(
        string $account,
        string $role = 'user',
        bool $transactions = null,
        int $limit = null,
        string $ledger_hash = null,
        string $ledger_index = null
    )
    {
        $params = ['account' => $account, 'role' => $role];

        if ($transactions !== null) { $params['transactions'] = $transactions; }
        if ($limit !== null) { $params['limit'] = $limit; }
        if ($ledger_hash !== null) { $params['ledger_hash'] = $ledger_hash; }
        if ($ledger_index !== null) { $params['ledger_index'] = $ledger_index; }

        return $this->post('noripple_check', $params);
    }
}
