<?php

namespace XRPHP\Tests\Transaction\Type;

use PHPUnit\Framework\TestCase;
use XRPHP\Transaction\Type\Skeleton;
use XRPHP\Transaction\TypeField;
use XRPHP\Transaction\TypeInterface;

class SkeletonTest extends TestCase
{
    /**
     * Check for syntax errors
     */
    public function testIsThereAnySyntaxError(): void
    {
        $obj = new Skeleton();
        $this->assertInternalType('object', $obj);
    }
}
