<?php

namespace XRPHP\Tests\Api\Anon\Account;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Tests\Api\MethodTestCase;

class LedgerEntryMethodTest extends MethodTestCase
{
    public function testSuccessMinParameters(): void
    {
        // Setup a successful response.
        $this->setResponse($this->getJsonFromFile('ledger_entry_success'));

        $params = [];
        $method = $this->client->method('ledger_entry', $params);

        $this->assertEquals('ledger_entry', $method->getMethod());
        $this->assertSame($params, $method->getParams());

        $res = $method->execute();

        $this->assertTrue($res->isSuccess(), 'isSuccess is not true');
    }

    public function testDirectoryNoDirectoryRootOrOwnerException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/directory\.owner or directory\.dir_root/');

        $this->client->method('ledger_entry', ['directory' => 'foo']);
    }

    public function testOfferNoOfferAccountException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/offer\.account/');

        $this->client->method('ledger_entry', [
            'offer' => 'foo',
            'offer.seq' => 'bar'
        ]);
    }

    public function testOfferNoOfferSeqException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/offer\.seq/');

        $this->client->method('ledger_entry', [
            'offer' => 'foo',
            'offer.account' => 'bar'
        ]);
    }

    public function testRippleStateNoAccountsException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/ripple_state\.accounts/');

        $this->client->method('ledger_entry', [
            'ripple_state' => 'foo',
            'ripple_state.currency' => 'bar'
        ]);
    }

    public function testRippleStateNoCurrencyException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessageRegExp('/ripple_state\.currency/');

        $this->client->method('ledger_entry', [
            'ripple_state' => 'foo',
            'ripple_state.accounts' => 'bar'
        ]);
    }
}
