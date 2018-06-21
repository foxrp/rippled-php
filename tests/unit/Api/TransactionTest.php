<?php

namespace XRPHP\Tests\Api;

use GuzzleHttp\Psr7\Response;
use XRPHP\Client;
use PHPUnit\Framework\TestCase;
use XRPHP\Exception\TransactionException;
use XRPHP\Exception\TransactionSignException;
use XRPHP\Api\Transaction;

/**
*  Test for Client class
*/
class TransactionTest extends TestCase
{
    /** @var Client */
    protected $client;

    /** @var \Http\Mock\Client */
    private $httpMockClient;

    protected function setUp()
    {
        $this->httpMockClient = new \Http\Mock\Client ();
        $this->client = new \XRPHP\Client('https://s1.ripple.com:51234', $this->httpMockClient);

        // Set default response for when no response is set in a test.
        $response = new Response(
            200,
            [],
            $this->getAccountInfoJson()
        );
        $this->httpMockClient->setDefaultResponse($response);
    }

    /**
    * Check for syntax errors
    */
    public function testIsThereAnySyntaxError(): void
    {
        $tx = $this->getTx();
        $transaction = new Transaction($tx);
        $this->assertInternalType('object', $transaction);
    }

    /**
     * Check that constructor creates tx from JSON string.
     */
    public function testConstructorWithJSONTx(): void
    {
        $tx = $this->getTx();
        $txJson = json_encode($tx);
        $transaction = new Transaction($txJson);

        $tx = $transaction->getTx();

        $this->assertNotNull($tx);
        $this->assertEquals('Payment', $tx['TransactionType']);
    }

    /**
     * Check that constructor throws exception with invalid tx type.
     */
    public function testConstructorWithBadTxTypeThrowsException(): void
    {
        $this->expectException(TransactionException::class);
        $this->expectExceptionMessageRegExp('/string or array/');

        $obj = new \stdClass();
        new Transaction($obj);
    }

    /**
     * Check that no Client is created when no args are passed in.
     */
    public function testNoClientIsCreatedWithConstructor(): void
    {
        $tx = $this->getTx();
        $transaction = new Transaction($tx);
        $client = $transaction->getClient();
        $this->assertNull($client);
    }

    /**
     * Check that Client is created when config is passed in.
     */
    public function testClientIsCreatedWithConstructor(): void
    {
        $tx = $this->getTx();
        $client = $this->client;

        $transaction = new Transaction($tx, $client);
        $client = $transaction->getClient();

        $this->assertNotNull($client);
        $this->assertEquals(\XRPHP\Client::class, \get_class($client));
    }

    /**
     * Check that basic sign functionality works.
     */
    public function testSignLocal()
    {
        $tx = $this->getTx();
        unset($tx['Sequence']);

        $transaction = new Transaction($tx, $this->client);
        $transaction->signLocal('saEiBcexrULNPiPn5MD3GPJeiU55U');

        $signedTx = $transaction->getTx();

        $this->assertNotNull($transaction->getTxBlob());
        $this->assertNotNull($transaction->getTxId());
        $this->assertTrue($transaction->isSigned());

        $this->assertEquals(6, $signedTx['Sequence']);
        $this->assertNotNull($signedTx['SigningPubKey']);
        $this->assertNotNull($signedTx['TxnSignature']);
    }

    /**
     * Check account sequence is returned.
     */
    public function testGetAccountSequence()
    {
        $tx = $this->getTx();
        $transaction = new Transaction($tx, $this->client);
        $sequence = $transaction->getAccountSequence($tx['Account']);

        $this->assertEquals(6, $sequence);
    }

    /**
     * Test getAccountSequence throws exception when no client exists.
     */
    public function testGetAccountSequenceNoClientThrowsException()
    {
        $this->expectException(TransactionSignException::class);
        $this->expectExceptionMessageRegExp('/Sequence/');

        $tx = $this->getTx();
        $transaction = new Transaction($tx);
        $sequence = $transaction->getAccountSequence($tx['Account']);
    }

    /*
    public function testGetAccountInfo()
    {
        $xrp = new Client('https://s.altnet.rippletest.net:51234');

        $params = [
            'account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
        ];
        $method = $xrp->method('account_info', $params);
        $res = $method->execute();

        print_r($res->getResult());
    }
    */

    /**
     * Check setting JSON with invalid JSON throws exception.
     */
    public function testSetJsonWithBadJsonThrowsException()
    {
        $this->expectException(TransactionException::class);
        $this->expectExceptionMessageRegExp('/JSON/');

        $tx = $this->getTx();
        $transaction = new Transaction($tx);

        $transaction->setJson('}');
    }

    public function testSetTypeWithMissingTypeThrowsException()
    {
        $this->expectException(TransactionException::class);
        $this->expectExceptionMessageRegExp('/TransactionType/');

        $tx = $this->getTx();
        $transaction = new Transaction($tx);

        unset($tx['TransactionType']);
        $transaction->setTx($tx);
    }

    private function getTx()
    {
        return [
            'TransactionType' => 'Payment',
            'Account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
            'Destination' => 'rnQ1WgToG2RL9Fjmofif9ixYVgJTi6BLas',
            'Amount' => '1000000',
            'Fee' => '000012',
            'Sequence' => 6
        ];
    }

    /**
     * Helper method to set the next response for the http client.
     *
     * @param string $body
     * @param int $status
     * @param array $headers
     */
    protected function setResponse(string $body, $status = 200, $headers = ['Content-Type' => 'application/json']): void
    {
        $response = new Response(
            $status,
            $headers,
            $body
        );
        $this->httpMockClient->addResponse($response);
    }

    private function getAccountInfoJson()
    {
        return file_get_contents(__dir__.'/../../json/account_info_success.json');
    }
}
