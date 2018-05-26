<?php

namespace XRPHP\Api;

interface MethodInterface
{
    public function getValidParameters(): array;
    public function validateParameters(array $params): void;
}