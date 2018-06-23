<?php declare(strict_types=1);

namespace FOXRP\Rippled\Api;

use FOXRP\Rippled\Exception\InvalidParameterException;

/**
 * {@inheritDoc}
 */
abstract class AbstractFieldable
{
    /** @var */
    protected $fields;

    /**
     * AbstractMethod constructor.
     *
     * @param array|null $params
     * @throws InvalidParameterException
     */
    public function __construct(array $params = null)
    {
        $this->setFields();
        if ($params !== null) {
            $this->validateParams($params);
        }
    }

    /**
     * Fields are added in the extended classes.
     */
    protected function setFields(): void
    {
    }

    /**
     * Basic validation based on field settings. Additional validation is to be done by overriding this method in the
     * extended class.
     *
     * @param array $params
     * @throws InvalidParameterException
     */
    public function validateParams(array $params): void
    {
        // Check for missing parameters.
        $reqFields = $this->getRequiredFields();
        $missingParams = [];
        foreach ($reqFields as $key => $field) {
            if (!isset($params[$key])) {
                $missingParams[] = $key;
            }
        }
        if (!empty($missingParams)) {
            throw new InvalidParameterException(
                sprintf(
                'Missing parameters: %s',
                    implode(', ', $missingParams)
            )
            );
        }

        // Check for invalid parameters.
        $paramKeys = array_keys($params);
        $fieldKeys = array_keys($this->fields);
        $invalidParams = array_diff($paramKeys, $fieldKeys);
        if (!empty($invalidParams)) {
            throw new InvalidParameterException(
                sprintf(
                'Invalid parameters submitted: %s',
                    implode(', ', $invalidParams)
            )
            );
        }
    }

    /**
     * @return array Required fields.
     */
    public function getRequiredFields(): array
    {
        $fields = [];
        foreach ($this->fields as $key => $field) {
            /** @var Field $field */
            if ($field->isRequired()) {
                $fields[$key] = $field;
            }
        }
        return $fields;
    }

    /**
     * Retrieves all fields
     *
     * @return null|array
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * Adds a fields to the transaction type.
     *
     * @param Field $field
     */
    public function addField(Field $field): void
    {
        $this->fields[$field->getName()] = $field;
    }

    /**
     * Retrieves a specific field by field name.
     *
     * @param string $name
     * @return null|Field
     */
    public function getField(string $name): ?Field
    {
        return $this->fields[$name] ?? null;
    }
}
