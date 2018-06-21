<?php

namespace XRPHP\Tests\Api;

use PHPUnit\Framework\TestCase;
use XRPHP\Api\Request;
use XRPHP\Client;

class RequestTest extends TestCase
{
    public function testSomething()
    {
        $this->assertTrue(true);
    }
    /*
    public function testRequest()
    {
        $client = new Client('https://s.altnet.rippletest.net:51234');
        $params = [
            'account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
        ];
        $req = new Request('account_info', $params, $client);
        $res = $req->send();

        print_r($res->getResult());
    }

    public function testRequest2()
    {
        $client = new Client('https://s.altnet.rippletest.net:51234');
        $params = [
            'account' => 'rQBnNY5w5cALHbMaue2VefSzuBfxafwqp9',
        ];
        $res = $client->send('account_info', $params);

        print_r($res->getResult());
    }
    */
}
