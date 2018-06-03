<?php

namespace XRPHP;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;
use XRPHP\Api\Method;

/**
 *  A rippled client.
 */
class Client
{
    /** @var HttpClient */
    private $httpClient;

    /** @var string */
    private $endpoint;

    /** @var string Hostname or IP of the endpoint */
    private $host;

    /** @var MessageFactory */
    protected $messageFactory;

    /** @var int Port of the endpoint */
    private $port;

    /** @var string http or https */
    private $scheme;

    /**
     * Maps API method names to their related class names in this package.
     *
     * @return array Associative array of method classes keyed by API method names.
     */
    private function getMethodClassMap()
    {
        return [
            'account_channels' => \XRPHP\Api\Anon\Account\AccountChannelsMethod::class,
            'account_currencies' => \XRPHP\Api\Anon\Account\AccountCurrenciesMethod::class,
            'account_info' => \XRPHP\Api\Anon\Account\AccountInfoMethod::class,
            'account_lines' => \XRPHP\Api\Anon\Account\AccountLinesMethod::class,
            'account_objects' => \XRPHP\Api\Anon\Account\AccountObjectsMethod::class,
            'account_offers' => \XRPHP\Api\Anon\Account\AccountOffersMethod::class,
            'account_tx' => \XRPHP\Api\Anon\Account\AccountTxMethod::class,
            'gateway_balances' => \XRPHP\Api\Anon\Account\GatewayBalancesMethod::class,
            'noripple_check' => \XRPHP\Api\Anon\Account\NorippleCheckMethod::class,
            'ledger' => \XRPHP\Api\Anon\Ledger\LedgerMethod::class,
            'ledger_closed' => \XRPHP\Api\Anon\Ledger\LedgerClosedMethod::class,
            'ledger_current' => \XRPHP\Api\Anon\Ledger\LedgerCurrentMethod::class,
            'ledger_data' => \XRPHP\Api\Anon\Ledger\LedgerDataMethod::class,
            'ledger_entry' => \XRPHP\Api\Anon\Ledger\LedgerEntryMethod::class,
            'sign' => \XRPHP\Api\Anon\Transaction\SignMethod::class,
            'sign_for' => \XRPHP\Api\Anon\Transaction\SignForMethod::class,
            'submit' => \XRPHP\Api\Anon\Transaction\SubmitMethod::class,
            'submit_multisigned' => \XRPHP\Api\Anon\Transaction\SubmitMultisignedMethod::class,
            'transaction_entry' => \XRPHP\Api\Anon\Transaction\TransactionEntryMethod::class,
            'tx' => \XRPHP\Api\Anon\Transaction\TxMethod::class,
            'book_offers' => \XRPHP\Api\Anon\PathOrderBook\BookOffersMethod::class
        ];
    }

    /**
     * Connection constructor.
     * @param $config
     * @param HttpClient|null $httpClient
     */
    public function __construct($config, HttpClient $httpClient = null, MessageFactory $messageFactory = null)
    {
        $type = gettype($config);

        switch ($type) {
            case 'string':
                $this->setEndpoint($config);
                break;

            case 'array':
                $this->setEndpoint($config['endpoint'] ?? null);
                break;

            default:
                throw new \InvalidArgumentException('Constructor argument must be endpoint string or config array');

        }

        if ($this->endpoint !== null) {
            $parts = parse_url($this->endpoint);
            if ($parts === false || !isset($parts['scheme'], $parts['host'])) {
                throw new \InvalidArgumentException('Invalid endpoint format');
            }

            $this->scheme = $parts['scheme'];
            $this->setHost($parts['host']);
            $this->setPort($parts['port'] ?? null);
        } else {
            $this->setScheme($config['scheme'] ?? null);
            $this->setHost($config['host'] ?? null);
            $this->setPort($config['port'] ?? null);
        }

        if (empty($this->scheme)) {
            throw new \InvalidArgumentException('scheme is required if endpoint is not supplied');
        }

        // Validate protocol
        if (!\in_array($this->scheme, ['http', 'https'])) {
            throw new \OutOfBoundsException('scheme must be http or https');
        }

        if (empty($this->host)) {
            throw new \InvalidArgumentException('host is required if endpoint is not supplied');
        }

        // Auto set port based on protocol if it has not been passed in
        $port = $config['port'] ?? ($this->getScheme() === 'https' ? 443 : 80);

        // Validate port
        if ($port < 1 || $port >= 65535) {
            throw new \OutOfBoundsException('port must be between 1 and 65535');
        }

        $this->port = $port;

        // Setup HttpClient & messageFactory
        $this->setHttpClient($httpClient ?: HttpClientDiscovery::find());
        $this->setMessageFactory($messageFactory ?: MessageFactoryDiscovery::find());

        // Build endpoint
        if (empty($this->endpoint)) {
            $this->setEndpoint($this->getScheme() . '://' . $this->getHost() . ':' . $this->getPort());
        }
    }

    /**
     * @param string $method The API method string.
     * @param array|null $params Associative array of method parameters.
     * @return null|Method
     * @throws \BadMethodCallException
     */
    public function method(string $method, array $params = null): ?Method
    {
        $methodMap = $this->getMethodClassMap();
        if (isset($methodMap[$method])) {
            return new $methodMap[$method]($this, $method, $params);
        }
        throw new \BadMethodCallException(sprintf('Invalid method: %s', $method));
    }

    /**
     * @param string $method The API method string.
     * @param array|null $params Associative array of method parameters.
     * @return string Raw JSON formatted to send in the API body.
     */
    public function prepareJson(string $method, array $params = null): string
    {
        if ($params === null) {
            $params = new \stdClass();
        }
        $request = ['method' => $method, 'params' => []];
        $request['params'][] = $params;
        return json_encode($request);
    }

    public function post(string $method, array $params = null)
    {
        $json = $this->prepareJson($method, $params);

        $request = $this->getMessageFactory()->createRequest(
            'POST',
            $this->endpoint,
            ['Content-Type' => 'application/json'],
            $json
        );

        return $this->httpClient->sendRequest($request);
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    public function setHttpClient(HttpClient $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    public function getMessageFactory(): MessageFactory
    {
        return $this->messageFactory;
    }

    public function setMessageFactory(MessageFactory $messageFactory): void
    {
        $this->messageFactory = $messageFactory;
    }

    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint = null): void
    {
        $this->endpoint = $endpoint;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(string $host = null): void
    {
        $this->host = $host;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setPort(int $port = null): void
    {
        $this->port = $port;
    }

    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    public function setScheme(string $scheme = null): void
    {
        $this->scheme = $scheme;
    }
}
