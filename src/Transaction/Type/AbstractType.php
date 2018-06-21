<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Transaction\TypeField;
use XRPHP\Transaction\TypeInterface;

/**
 * Base transaction class which each transaction extends.
 *
 * @link https://developers.ripple.com/transaction-common-fields.html Documentation for Transaction common.
 */
abstract class AbstractType implements TypeInterface
{
    /** @var array */
    private $fields;

    /**
     * AbstractType constructor.
     * @param array|null $params
     * @throws InvalidParameterException
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function __construct(array $params = null)
    {
        $this->setFields();
        if ($params !== null) {
            $this->validateParams($params);
        }
    }

    /**
     * @throws \XRPHP\Exception\TransactionTypeFieldException
     */
    public function setFields(): void
    {
        // GENERATED CODE FROM bin/generate.php types
        // BEGIN GENERATED
        $this->addField(new TypeField([
            'name' => 'Account',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'TransactionType',
            'required' => true,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Fee',
            'required' => true,
            'autoFillable' => true
        ]));

        $this->addField(new TypeField([
            'name' => 'Sequence',
            'required' => true,
            'autoFillable' => true
        ]));

        $this->addField(new TypeField([
            'name' => 'AccountTxnID',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Flags',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'LastLedgerSequence',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Memos',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'Signers',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'SourceTag',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'SigningPubKey',
            'required' => false,
            'autoFillable' => false
        ]));

        $this->addField(new TypeField([
            'name' => 'TxnSignature',
            'required' => false,
            'autoFillable' => false
        ]));

        // END GENERATED
    }

    /**
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
            throw new InvalidParameterException(sprintf('Missing parameters: %s',
                    implode(', ', $missingParams))
            );
        }

        // Check for invalid parameters.
        $paramKeys = array_keys($params);
        $fieldKeys = array_keys($this->fields);
        $invalidParams = array_diff($paramKeys, $fieldKeys);
        if (!empty($invalidParams)) {
            throw new InvalidParameterException(sprintf('Invalid parameters submitted: %s',
                    implode(', ', $invalidParams))
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
            /** @var TypeField $field */
            if ($field->isRequired() && !$field->isAutoFillable()) {
                $fields[$key] = $field;
            }
        }
        return $fields;
    }

    /**
     * @return array Aufo-fillable fields.
     */
    public function getAutofillableFields(): array
    {
        $fields = [];
        foreach ($this->fields as $key => $field) {
            /** @var TypeField $field */
            if ($field->isAutoFillable()) {
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
     * @param TypeField $field
     */
    public function addField(TypeField $field): void
    {
        $this->fields[$field->getName()] = $field;
    }

    /**
     * Retrieves a specific field by field name.
     *
     * @param string $name
     * @return null|TypeField
     */
    public function getField(string $name): ?TypeField
    {
        return $this->fields[$name] ?? null;
    }
}
