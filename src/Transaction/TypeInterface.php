<?php

namespace XRPHP\Transaction;

interface TypeInterface
{
    public function setFields(): void;
    public function addField(TypeField $field): void;
    public function getField(string $name): ?TypeField;
    public function getFields(): ?array;
    public function getRequiredFields(): array;
    public function getAutofillableFields(): array;
    public function validateParams(array $params): void;
}
