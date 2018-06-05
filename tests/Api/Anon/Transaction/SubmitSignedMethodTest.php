<?php

namespace XRPHP\Tests\Api\Anon\Transaction;

use XRPHP\Tests\Api\SignMethodTestCase;

class SubmitSignedMethodTest extends SignMethodTestCase
{
    public function __construct()
    {
        $this->method = 'submit';
        parent::__construct();
    }
}
