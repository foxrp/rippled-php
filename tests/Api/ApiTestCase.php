<?php

namespace XRPHP\Tests\Api;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use XRPHP\Client;

abstract class ApiTestCase extends TestCase
{
    /** @var Client */
    protected $client;

    /** @var \Http\Mock\Client */
    protected $httpMockClient;

    /** @var array */
    protected $expectedResponse;

    /** @var string */
    protected $testClass;

    /** @var array */
    protected $defaultParamValues;

    /** @var string */
    protected static $ACCOUNT_ID = 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn';

    public function __construct()
    {
        parent::__construct();

        // Create an array of default API params for testing.
        $this->defaultParamsValues = [
            'account' => self::$ACCOUNT_ID,
            'binary' => false,
            'destination_account' => self::$ACCOUNT_ID,
            'forward' => false,
            'hotwallet' => self::$ACCOUNT_ID,
            'ledger_hash' => 'ledger_hash',
            'ledger_index' => 'ledger_index',
            'ledger_min' => 100,
            'ledger_max' => 200,
            'limit' => 200,
            'marker' => 'marker',
            'peer' => self::$ACCOUNT_ID,
            'queue' => false,
            'role' => 'user',
            'signer_lists' => false,
            'strict' => false,
            'transactions' => false
        ];
    }

    protected function setUp()
    {
        $this->httpMockClient = new \Http\Mock\Client ();
        $this->client = new \XRPHP\Client('https://s1.ripple.com:51234', $this->httpMockClient);

        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"status":1}'
        );
        $this->httpMockClient->setDefaultResponse($response);

        $this->expectedResponse = ['status' => 1];
    }

    protected function runMethodTest(string $method)
    {
        $methodData = $this->getMethodData($method);
        $this->assertNotEmpty($methodData['command'], 'Missing @command annotation on method');

        $params = [];
        if ($methodData['params'] !== null) {
            foreach ($methodData['params'] as $param) {
                if (!isset($this->defaultParamsValues[$param])) {
                    $this->fail('Missing default param in ApiTestCase: ' . $param);
                }
                $params[$param] = $this->defaultParamsValues[$param];
            }
        }

        $response = $this->client->account()->{$method}(...array_values($params));

        // Test request
        $this->requestAssertions($methodData['command'], $params);

        // Test response
        $this->assertSame($this->expectedResponse, $response);
    }

    protected function requestAssertions($method, $params): void
    {
        $request = $this->httpMockClient->getLastRequest();

        $contentType = $request->getHeaderLine('Content-Type');
        $this->assertEquals('application/json', $contentType);

        $body = $request->getBody();
        $command = json_decode($body, true);
        $this->assertEquals(JSON_ERROR_NONE, json_last_error());

        $this->commandAssertions($command, $method, $params);
    }

    protected function commandAssertions(array $command, string $method = null, array $params = null): void
    {
        $this->assertArrayHasKey('method', $command);
        $this->assertArrayHasKey('params', $command);
        $this->assertArrayHasKey(0, $command['params']);
        $this->assertArrayHasKey('account', $command['params'][0]);

        if ($method !== null) {
            $this->assertEquals($method, $command['method']);
        }

        if ($params !== null) {
            $this->assertSame($params, $command['params'][0]);
        }
    }

    protected function getMethodData(string $method): array
    {
        $data = [];
        $r = $this->getMethodReflector($method);
        $data['command'] = $this->getMethodCommand($r);
        $data['params'] = $this->getMethodParams($r);

        return $data;
    }

    protected function getMethodReflector(string $method)
    {
        return new \ReflectionMethod($this->testClass, $method);
    }

    protected function getMethodCommand(\ReflectionMethod $r): ?string
    {
        $command = null;

        $doc = $r->getDocComment();
        preg_match('#@command=\"(.*?)\".*#s', $doc, $annotations);
        if (is_array($annotations) && isset($annotations[1])) {
            $command = $annotations[1];
        }

        return $command;
    }

    protected function getMethodParams(\ReflectionMethod $r): ?array
    {
        $params = null;

        $p = $r->getParameters();
        if (is_array($p)) {
            foreach ($p as $key => $obj) {
                $params[$key] = $obj->name;
            }
        }

        return $params;
    }
}
