<?php

namespace XRPHP\Tests;

use XRPHP\Client;
use PHPUnit\Framework\TestCase;
use XRPHP\Transaction;
use XRPHP\XRPHP;

/**
*  Test for Client class
*/
class XRPHPTest extends TestCase
{
    /**
    * Check for syntax errors
    */
    public function testIsThereAnySyntaxError(): void
    {
        $xrphp = new XRPHP('https://example.com');
        $this->assertInternalType('object', $xrphp);
    }

    /**
     * Check that no Client is created when no args are passed in.
     */
    public function testNoClientIsCreatedWithConstructor(): void
    {
        $xrphp = new XRPHP();
        $client = $xrphp->getClient();
        $this->assertNull($client);
    }

    /**
     * Check that Client is created when config is passed in.
     */
    public function testClientIsCreatedWithConstructor(): void
    {
        $xrphp = new XRPHP('https://example.com');
        $client = $xrphp->getClient();

        $this->assertNotNull($client);
        $this->assertEquals(\XRPHP\Client::class, \get_class($client));
    }

    public function testTransactionFactory()
    {
        $xrphp = new XRPHP('https://example.com');
        $txJson = $this->getTx();

        $transaction = $xrphp->transaction($txJson);
        $this->assertEquals(\XRPHP\Transaction::class, \get_class($transaction));

        $client = $transaction->getClient();
        $this->assertEquals(\XRPHP\Client::class, \get_class($client));
    }

    /*
    public function testGetTx()
    {
        $xrp = new Client('https://s.altnet.rippletest.net:51234');

        $params = [
            'tx_json' => [
                'TransactionType' => 'Payment',
                'Account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
                'Destination' => 'rnQ1WgToG2RL9Fjmofif9ixYVgJTi6BLas',
                'Amount' => '1000000'
            ],
            'secret' => 'saEiBcexrULNPiPn5MD3GPJeiU55U'
        ];
        $method = $xrp->method('submit', $params);
        $res = $method->execute();

        $params = [
            'account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9'
        ];
        $method = $xrp->method('account_info', $params);
        $res = $method->execute();

        print_r($res->getResult());


    }

    public function testSign()
    {
        $params = [
            'TransactionType' => 'Payment',
            'Account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
            'Destination' => 'rnQ1WgToG2RL9Fjmofif9ixYVgJTi6BLas',
            'Amount' => '1000000',
            'Fee' => '0000012',
            'Sequence' => 4
        ];

        $tx = new Transaction($params);
        $tx->sign('saEiBcexrULNPiPn5MD3GPJeiU55U');

        $xrp = new Client('https://s.altnet.rippletest.net:51234');

        $method = $xrp->method('submit', ['tx_blob' => $tx->getTxBlob()]);
        $res = $method->execute();

        print_r($res);
    }

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
            'Amount' => '1000000'
        ];
    }

}
