<?php

namespace FOXRP\Rippled\Tests\Transaction\Type;

use PHPUnit\Framework\TestCase;
use FOXRP\Rippled\Api\TransactionType\Skeleton;

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
