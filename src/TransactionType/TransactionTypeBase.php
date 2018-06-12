<?php

namespace XRPHP\TransactionType;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Transaction\TransactionField;

/**
 * Base transaction class which each transaction extends.
 *
 * @link https://developers.ripple.com/transaction-common-fields.html Documentation for Transaction common.
 * @package XRPHP\TransactionType
 */
abstract class TransactionTypeBase
{
    /** @var array */
    private $fields;

    public function __construct()
    {
        $this->setFields();
    }

    public function setFields(): void
    {
        $this->addField(new TransactionField([
            'name' => 'TransactionType',
            'description' => 'The type of transaction.',
            'required' => true
        ]));

        $this->addField(new TransactionField([
            'name' => 'Account',
            'description' => 'The unique address of the account that initiated the transaction.',
            'required' => true
        ]));

        $this->addField(new TransactionField([
            'name' => 'Fee',
            'description' => 'Integer amount of XRP, in drops, to be destroyed as a cost for distributing this transaction to the network. Some transaction types have different minimum requirements.',
            'required' => true,
            'autoFillable' => true
        ]));

        $this->addField(new TransactionField([
            'name' => 'Sequence',
            'description' => 'The sequence number, relative to the initiating account, of this transaction. ',
            'required' => true,
            'autoFillable' => true
        ]));

        $this->addField(new TransactionField([
            'name' => 'AccountTxnID',
            'description' => 'Hash value identifying another transaction. If provided, this transaction is only valid if the sending account\'s previously-sent transaction matches the provided hash.',
        ]));

        $this->addField(new TransactionField([
            'name' => 'Flags',
            'description' => 'Set of bit-flags for this transaction.',
            'jsonType' => 'Unsigned Integer'
        ]));

        $this->addField(new TransactionField([
            'name' => 'LastLedgerSequence',
            'description' => 'Highest ledger index this transaction can appear in. Specifying this field places a strict upper limit on how long the transaction can wait to be validated or rejected.',
            'jsonType' => 'Number'
        ]));

        $this->addField(new TransactionField([
            'name' => 'Memos',
            'description' => 'Additional arbitrary information used to identify this transaction.',
            'jsonType' => 'Array'
        ]));

        $this->addField(new TransactionField([
            'name' => 'Signers',
            'description' => 'Array of objects that represent a multi-signature which authorizes this transaction.',
            'jsonType' => 'Array'
        ]));

        $this->addField(new TransactionField([
            'name' => 'SourceTag',
            'description' => 'Arbitrary integer used to identify the reason for this payment, or a sender on whose behalf this transaction is made.',
            'jsonType' => 'Unsigned Integer'
        ]));

        $this->addField(new TransactionField([
            'name' => 'SignPubKey',
            'description' => 'Hex representation of the public key that corresponds to the private key used to sign this transaction.'
        ]));

        $this->addField(new TransactionField([
            'name' => 'TxnSignature',
            'description' => 'The signature that verifies this transaction as originating from the account it says it is from.'
        ]));
    }

    /**
     * Adds a fields to the transaction type.
     *
     * @param TransactionField $field
     */
    public function addField(TransactionField $field): void
    {
        $this->fields[$field->getName()] = $field;
    }

    /**
     * Retrieves a specific field by field name.
     *
     * @param string $name
     * @return null|TransactionField
     */
    public function getField(string $name): ?TransactionField
    {
        return $this->fields[$name] ?? null;
    }

    /**
     * @return array Required fields.
     */
    public function getRequiredFields(): array
    {
        $fields = [];
        foreach ($this->fields as $key => $field) {
            /** @var TransactionField $field */
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
            /** @var TransactionField $field */
            if ($field->isAutoFillable()) {
                $fields[$key] = $field;
            }
        }
        return $fields;
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
        $validParamKeys = array_intersect_key($paramKeys, $fieldKeys);
        $invalidParams = array_diff($paramKeys, $validParamKeys);
        if (!empty($invalidParams)) {
            throw new InvalidParameterException(sprintf('Invalid parameters submitted: %s',
                implode(', ', $invalidParams))
            );
        }
    }

    /**
     * @param array $params
     * @return string
     * @throws InvalidParameterException
     */
    public function getJson(array $params): string
    {
        $this->validateParams($params);
        return json_encode($params);
    }

    /**
     * @param array|string $params Array or JSON string of parameters.
     * @return string
     * @throws InvalidParameterException
     */
    public function getTx($params): string
    {
        if (\is_string($params)) {
            $params = json_decode($params, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidParameterException('Invalid JSON params');
            }
        } elseif (\is_array($params)) {
            $params = $this->getJson($params);
        } else {
            throw new InvalidParameterException('Parameters must be passed in as an array or JSON');
        }
        return bin2hex($params);
    }
}
