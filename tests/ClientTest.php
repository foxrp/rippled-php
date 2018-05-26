<?php

namespace XRPHP\Tests;

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
        $con = new Client('https://example.com');
        $this->assertTrue(is_object($con));
        unset($con);
    }

    /**
    * Check constructor defaults
    */
    public function testConstructorString(): void
    {
        $con = new Client('https://example.com');
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
        $con = new Client(['scheme' => 'https', 'host' => 'example.com']);
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
        $con = new Client(['scheme' => 'http', 'host' => 'example.com', 'port' => 5006]);
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
        $con = new Client(['scheme' => 'ssh', 'host' => 'example.com']);
        unset($con);
    }

    /**
     * Check constructor with invalid port
     */
    public function testConstructorInvalidPort(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $con = new Client(['scheme' => 'https', 'host' => 'example.com', 'port' => 65599]);
        unset($con);
    }

    /**
     * Check constructor created a Guzzle client
     */
    public function testConstructorHttpGuzzleClient(): void
    {
        $con = new Client(['endpoint' => 'https://example.com']);
        $httpClient = $con->getHttpClient();
        $this->assertNotNull($httpClient);
        $this->assertEquals(\Http\Adapter\Guzzle6\Client::class, get_class($httpClient));
        unset($con);
    }

    /**
     * Check constructor set endpoint correctly
     */
    public function testConstructorEndpoint(): void
    {
        $con = new Client(['scheme' => 'https', 'host' => 'example.com']);
        $this->assertEquals('https://example.com:443', $con->getEndpoint());
        unset($con);
    }
}
