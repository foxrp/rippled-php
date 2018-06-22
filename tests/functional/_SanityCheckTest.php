<?php declare(strict_types=1);

namespace XRPHP\FunctionalTests;

class _SanityCheckTest extends FunctionalTestCase
{
    public function testEnvironmentVarsExist()
    {
        $this->assertNotEmpty($this->endpoint);
        $this->assertNotEmpty($this->acct1Id);
        $this->assertNotEmpty($this->acct1Secret);
        $this->assertNotEmpty($this->acct2Id);
    }

    public function testAccountHasSufficientFundsForTestSuite()
    {
        $res = $this->client->send('account_info', [
            'account' => $this->acct1Id
        ]);
        $data = $res->getResult();
        $this->assertGreaterThan(100000000, $data['account_data']['Balance']);
    }
}
