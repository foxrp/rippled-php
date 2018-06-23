<?php

namespace FOXRP\Rippled\Tests\Api\Method;

use PHPUnit\Framework\TestCase;
use FOXRP\Rippled\Api\Method\Skeleton;

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
