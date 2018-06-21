<?php

namespace XRPHP\Tests\Api;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use PHPUnit\Framework\TestCase;
use XRPHP\Api\Response;

class ResponseTest extends TestCase
{
    /** @var string */
    private $jsonSuccess;

    /** @var Response */
    private $responseSuccess;

    /** @var string */
    private $jsonError;

    /** @var Response */
    private $responseError;

    protected function setUp()
    {
        $this->jsonSuccess = $this->getJsonFromFile('res_account_info_success');
        $this->responseSuccess = new GuzzleResponse(200, ['Content-Type' => 'application/json'], $this->jsonSuccess);

        $this->jsonError = $this->getJsonFromFile('res_account_info_error');
        $this->responseError = new GuzzleResponse(200, ['Content-Type' => 'application/json'], $this->jsonError);
    }

    /**
     * Check for syntax errors
     */
    public function testIsThereAnySyntaxError(): void
    {
        $obj = new Response($this->responseSuccess);
        $this->assertTrue(is_object($obj));
    }

    public function testSetRaw(): void
    {
        $obj = new Response($this->responseSuccess);
        $this->assertSame($this->jsonSuccess, $obj->getRaw());
    }

    public function testInvalidJson()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessageRegExp('/^Unable to parse/');

        $badResponse = new GuzzleResponse(200, ['Content-Type' => 'application/json'], "{");
        new Response($badResponse);
    }

    public function testNoResult()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessageRegExp('/missing result data/');

        $badResponse = new GuzzleResponse(200, ['Content-Type' => 'application/json'], "{}");
        $obj = new Response($badResponse);

        $this->assertTrue(is_object($obj));
    }

    public function testSetResut()
    {
        $data = json_decode($this->jsonSuccess, true);
        $expectedResult = $data['result'];

        $obj = new Response($this->responseSuccess);
        $this->assertSame($expectedResult, $obj->getResult());
    }

    public function testHasError(): void
    {
        $obj = new Response($this->responseError);
        $this->assertTrue($obj->hasError());
        $this->assertEquals(19, $obj->getErrorCode());
        $this->assertEquals('Account not found.', $obj->getErrorMessage());
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
