<?php

namespace XRPHP\Tests;

use XRPHP\Api\Anon\Account\AccountInfoMethod;
use XRPHP\Client;
use PHPUnit\Framework\TestCase;

/**
*  Test for Client class
*/
class ClientTest extends TestCase
{
    /**
    * Check for syntax errors
    */
    public function testIsThereAnySyntaxError(): void
    {
        $client = new Client('https://example.com');
        $this->assertTrue(is_object($client));
        unset($client);
    }

    public function testInvalidConstructorType(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $client = new Client(new \stdClass());
        unset($client);
    }

    public function testInvalidUriFormat(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $client = new Client('asdf');
        unset($client);
    }

    /**
    * Check constructor defaults
    */
    public function testConstructorString(): void
    {
        $client = new Client('https://example.com');
        $this->assertEquals('example.com', $client->getHost());
        $this->assertEquals('https', $client->getScheme());
        $this->assertEquals(443, $client->getPort());
        unset($client);
    }

    /**
     * Check constructor defaults with https
     */
    public function testConstructorConfigDefaultHttpsPort(): void
    {
        $client = new Client(['scheme' => 'https', 'host' => 'example.com']);
        $this->assertEquals('example.com', $client->getHost());
        $this->assertEquals('https', $client->getScheme());
        $this->assertEquals(443, $client->getPort());
        unset($client);
    }

    public function testConstructorCustomArgs(): void
    {
        $client = new Client(['scheme' => 'http', 'host' => 'example.com', 'port' => 5006]);
        $this->assertEquals('example.com', $client->getHost());
        $this->assertEquals('http', $client->getScheme());
        $this->assertEquals(5006, $client->getPort());
        unset($client);
    }

    public function testConstructorMissingScheme(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $client = new Client(['host' => 'example.com']);
        unset($client);
    }

    public function testConstructorMissingHost(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $client = new Client(['scheme' => 'https']);
        unset($client);
    }

    /**
     * Check constructor with invalid protocol
     */
    public function testConstructorInvalidProtocol(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $client = new Client(['scheme' => 'ssh', 'host' => 'example.com']);
        unset($client);
    }

    /**
     * Check constructor with invalid port
     */
    public function testConstructorInvalidPort(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $client = new Client(['scheme' => 'https', 'host' => 'example.com', 'port' => 65599]);
        unset($client);
    }

    /**
     * Check constructor created a Guzzle client
     */
    public function testConstructorHttpGuzzleClient(): void
    {
        $client = new Client(['endpoint' => 'https://example.com']);
        $httpClient = $client->getHttpClient();
        $this->assertNotNull($httpClient);
        $this->assertEquals(\Http\Adapter\Guzzle6\Client::class, get_class($httpClient));
        unset($client);
    }

    /**
     * Check constructor set endpoint correctly
     */
    public function testConstructorEndpoint(): void
    {
        $client = new Client(['scheme' => 'https', 'host' => 'example.com']);
        $this->assertEquals('https://example.com:443', $client->getEndpoint());
        unset($client);
    }

    public function testMethodSuccess()
    {
        $client = new Client('https://example.com');
        $method = $client->method('account_info', ['account' => '123']);

        $this->assertEquals(AccountInfoMethod::class, \get_class($method));
    }

    public function testMethodInvalidMethod()
    {
        $this->expectException(\BadMethodCallException::class);

        $client = new Client('https://example.com');
        $client->method('invalid_method', ['account' => '123']);
    }

    public function testPrepareJsonWithParams()
    {
        $expected = json_encode([
            'method' => 'account_info',
            'params' => [[
                'account' => '12345'
            ]]
        ]);

        $client = new Client('https://example.com');
        $json = $client->prepareJson('account_info', ['account' => '12345']);

        $this->assertSame($expected, $json);
    }

    public function testPrepareJsonWithoutParams()
    {
        $expected = json_encode([
            'method' => 'account_info',
            'params' => [new \stdClass()]
        ]);

        $client = new Client('https://example.com');
        $json = $client->prepareJson('account_info');

        $this->assertSame($expected, $json);
    }
}
