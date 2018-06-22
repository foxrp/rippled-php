<?php declare(strict_types=1);

namespace XRPHP\Api;

/**
 * Fieldable provides methods to build fieldable objects which can be validated.
 */
interface FieldableInterface
{
    public function __construct(array $params = null);
    public function setFields(): void;
    public function validateParams(array $params): void;
    public function getRequiredFields(): array;
    public function getFields(): ?array;
    public function addField(Field $field): void;
    public function getField(string $name): ?Field;
}
