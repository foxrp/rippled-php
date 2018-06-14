<?php

namespace XRPHP\TransactionType;

interface TransactionTypeInterface
{
    public function addField(): array;
    public function addFields(): array;
    public function getField(): array;
    public function getRequiredFields(): array;
    public function validateParams(): void;
    public function getJson(array $params): string;
    public function getTx($params): string;
}
