<?php

namespace FOXRP\Rippled\Tests\Api;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use FOXRP\Rippled\Api\Method;
use FOXRP\Rippled\Client;

class MethodTestCase extends TestCase
{
    /** @var Client */
    protected $client;

    /** @var \Http\Mock\Client */
    protected $httpMockClient;

    /** @var array */
    protected $expectedResponse;

    /** @var string */
    protected $testClass;

    /** @var array */
    protected $defaultParamValues;

    /** @var string */
    protected static $ACCOUNT_ID = 'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn';

    protected function setUp()
    {
        $this->httpMockClient = new \Http\Mock\Client ();
        $this->client = new \FOXRP\Rippled\Client('https://s1.ripple.com:51234', $this->httpMockClient);

        // Set default response for when no response is set in a test.
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"result":{"status":1}}'
        );
        $this->httpMockClient->setDefaultResponse($response);
    }

    public function testGetValidParameters()
    {
        /** @var Method $obj */
        $obj = $this->getMockForAbstractClass(
            Method::class,
            [$this->client, 'account_info', ['account' => '12345']]
        );

        $result = $obj->getValidParameters();
        $this->assertNull($result);
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

    /**
     * Helper method to retrieve json from file.
     *
     * @param string $file
     * @return bool|string
     */
    protected function getJsonFromFile(string $file)
    {
        return file_get_contents(__dir__.'../../../json/'.$file.'.json');
    }
}
