<?php declare(strict_types=1);

namespace XRPHP\FunctionalTests\Api\Method;

use XRPHP\FunctionalTests\FunctionalTestCase;

class AccountInfoTest extends FunctionalTestCase
{
    public function testAccountInfoSuccess()
    {
        $res = $this->client->send('account_info', [
            'account' => $this->acct1Id
        ]);
        $data = $res->getResult();
        $this->assertGreaterThan(100000000, $data['account_data']['Balance']);
    }
}
