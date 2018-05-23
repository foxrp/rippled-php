<?php

namespace XRPhp\Tests;

use XRPhp\Connection;
use PHPUnit\Framework\TestCase;

/**
*  Test for Connection class
*/
class ConnectionTest extends TestCase
{
    /**
    * Check for syntax errors
    */
    public function testIsThereAnySyntaxError(): void
    {
        $con = new Connection('https://example.com');
        $this->assertTrue(is_object($con));
        unset($con);
    }

    /**
    * Check constructor defaults
    */
    public function testConstructorString(): void
    {
        $con = new Connection('https://example.com');
        $this->assertEquals('example.com', $con->getHost());
        $this->assertEquals('https', $con->getScheme());
        $this->assertEquals(443, $con->getPort());
        unset($con);
    }

    /**
     * Check constructor defaults with https
     */
    public function testConstructorConfigDefaultHttpsPort(): void
    {
        $con = new Connection(['scheme' => 'https', 'host' => 'example.com']);
        $this->assertEquals('example.com', $con->getHost());
        $this->assertEquals('https', $con->getScheme());
        $this->assertEquals(443, $con->getPort());
        unset($con);
    }

    /**
     * Check constructor with all custom args
     */
    public function testConstructorCustomArgs(): void
    {
        $con = new Connection(['scheme' => 'http', 'host' => 'example.com', 'port' => 5006]);
        $this->assertEquals('example.com', $con->getHost());
        $this->assertEquals('http', $con->getScheme());
        $this->assertEquals(5006, $con->getPort());
        unset($con);
    }

    /**
     * Check constructor with invalid protocol
     */
    public function testConstructorInvalidProtocol(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $con = new Connection(['scheme' => 'ssh', 'host' => 'example.com']);
        unset($con);
    }

    /**
     * Check constructor with invalid port
     */
    public function testConstructorInvalidPort(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $con = new Connection(['scheme' => 'https', 'host' => 'example.com', 'port' => 65599]);
        unset($con);
    }

    /**
     * Check constructor created a Guzzle client
     */
    public function testConstructorHttpGuzzleClient(): void
    {
        $con = new Connection(['endpoint' => 'https://example.com']);
        $client = $con->getClient();
        $this->assertNotNull($client);
        $this->assertEquals(\Http\Adapter\Guzzle6\Client::class, get_class($client));
        unset($con);
    }

    /**
     * Check constructor set endpoint correctly
     */
    public function testConstructorEndpoint(): void
    {
        $con = new Connection(['scheme' => 'https', 'host' => 'example.com']);
        $this->assertEquals('https://example.com:443', $con->getEndpoint());
        unset($con);
    }

    /**
     * Check prepareRequest encodes command and params into json properly.
     */
    public function testPrepareRequest(): void
    {
        $con = new Connection(['endpoint' => 'https://s2.ripple.com:51234']);
        $json = $con->prepareRequest('account_info', [
            'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn',
            'strict' => true,
            'ledger_index' => 'current',
            'queue' => true
        ]);

        $this->assertTrue(is_string($json));

        $req = json_decode($json);
        $this->assertEquals('account_info', $req->method);
        $this->assertEquals(true, $req->params[0]->strict);
        $this->assertEquals('current', $req->params[0]->ledger_index);
        $this->assertEquals(true, $req->params[0]->queue);
        unset($con);
    }

    /**
     * Test response
     */
//    public function testSend(): void
//    {
//        $con = new Connection(['endpoint' => 'https://s1.ripple.com:51234']);
//        $resp = $con->send('account_info', [
//            'account' => 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn',
//            'strict' => true,
//            'ledger_index' => 'current',
//            'queue' => true
//        ]);
//
//        $this->assertTrue(is_array($resp));
//    }
}
