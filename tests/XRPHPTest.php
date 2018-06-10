<?php

namespace XRPHP\Tests;

use XRPHP\Api\Anon\Account\AccountInfoMethod;
use XRPHP\Client;
use PHPUnit\Framework\TestCase;
use XRPHP\Exception\TransactionException;
use XRPHP\Exception\TransactionTypeException;
use XRPHP\Transaction;
use XRPHP\XRP;

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
        $xrphp = new XRP('https://example.com');
        $this->assertTrue(is_object($xrphp));
        unset($xrphp);
    }

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
            'Amount' => '1000000'
        ];

        $tx = new Transaction($params);
        $tx->sign('saEiBcexrULNPiPn5MD3GPJeiU55U');
        $data = $tx->getTx();
        $blob = $data['signedTransaction'];

        $xrp = new Client('https://s.altnet.rippletest.net:51234');

        $method = $xrp->method('submit', ['tx_blob' => $blob]);
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
}
