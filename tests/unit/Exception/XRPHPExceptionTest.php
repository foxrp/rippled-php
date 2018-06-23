<?php declare(strict_types=1);

namespace FOXRP\Rippled\Tests\Exception;

use PHPUnit\Framework\TestCase;
use FOXRP\Rippled\Exception\RippledException;

class RippledExceptionTest extends TestCase
{
    public function testToString(): void
    {
        $obj = new RippledException('Foo', 1);
        $this->assertEquals('FOXRP\Rippled\Exception\RippledException: [1]: Foo'."\n", $obj->__toString());
    }
}
