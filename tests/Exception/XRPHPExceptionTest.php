<?php declare(strict_types=1);

namespace XRPHP\Tests\Exception;

use PHPUnit\Framework\TestCase;
use XRPHP\Exception\XRPHPException;

class XRPHPExceptionTest extends TestCase
{
    public function testToString(): void
    {
        $obj = new XRPHPException('Foo', 1);
        $this->assertEquals('XRPHP\Exception\XRPHPException: [1]: Foo'."\n", $obj->__toString());
    }
}
