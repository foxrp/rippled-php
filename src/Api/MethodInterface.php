<?php declare(strict_types=1);

namespace XRPHP\Api;

interface MethodInterface
{
    public function getValidParameters(): array;
    public function validateParameters(array $params): void;
}
