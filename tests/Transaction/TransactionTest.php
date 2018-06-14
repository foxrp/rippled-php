<?php

namespace XRPHP\Tests\Api\Anon\Transaction;

use PHPUnit\Framework\TestCase;
use XRPHP\Client;
use XRPHP\Transaction;

/**
*  Test for Client class
*/
class TransactionTest extends TestCase
{
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
        $client = new Client('https://example.com');
        $transaction = new Transaction($tx, $client);
        $client = $transaction->getClient();

        $this->assertNotNull($client);
        $this->assertEquals(\XRPHP\Client::class, \get_class($client));
    }

    /*
    public function testSignLocal()
    {
        $client = new Client('https://example.com');
        $params = [
            'TransactionType' => 'Payment',
            'Account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
            'Destination' => 'rnQ1WgToG2RL9Fjmofif9ixYVgJTi6BLas',
            'Amount' => '1000000',
            'Fee' => '0000012'
        ];

        $tx = new Transaction($params, $client);
        $tx->signLocal('saEiBcexrULNPiPn5MD3GPJeiU55U');

        $xrp = new Client('https://s.altnet.rippletest.net:51234');

        $method = $xrp->method('submit', ['tx_blob' => $tx->getTxBlob()]);
        $res = $method->execute();

        print_r($res);

    }
         */

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

    private function getTx()
    {
        return [
            'TransactionType' => 'Payment',
            'Account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
            'Destination' => 'rnQ1WgToG2RL9Fjmofif9ixYVgJTi6BLas',
            'Amount' => '1000000',
            'Fee' => '000012'
        ];
    }
}
