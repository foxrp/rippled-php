<?php

namespace XRPHP\Transaction\Type;

use XRPHP\Exception\InvalidParameterException;
use XRPHP\Transaction\TypeField;

/**
 * Base transaction class which each transaction extends.
 *
 * @link https://developers.ripple.com/transaction-common-fields.html Documentation for Transaction common.
 * @package XRPHP\TransactionType
 */
abstract class AbstractType
{
    /** @var array */
    private $fields;

    /**
     * AbstractType constructor.
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

    public function setFields(): void
    {
        $this->addField(new TypeField([
            'name' => 'TransactionType',
            'description' => 'The type of transaction.',
            'required' => true
        ]));

        $this->addField(new TypeField([
            'name' => 'Account',
            'description' => 'The unique address of the account that initiated the transaction.',
            'required' => true
        ]));

        $this->addField(new TypeField([
            'name' => 'Fee',
            'description' => 'Integer amount of XRP, in drops, to be destroyed as a cost for distributing this transaction to the network. Some transaction types have different minimum requirements.',
            'required' => true,
            'autoFillable' => true
        ]));

        $this->addField(new TypeField([
            'name' => 'Sequence',
            'description' => 'The sequence number, relative to the initiating account, of this transaction. ',
            'required' => true,
            'autoFillable' => true
        ]));

        $this->addField(new TypeField([
            'name' => 'AccountTxnID',
            'description' => 'Hash value identifying another transaction. If provided, this transaction is only valid if the sending account\'s previously-sent transaction matches the provided hash.',
        ]));

        $this->addField(new TypeField([
            'name' => 'Flags',
            'description' => 'Set of bit-flags for this transaction.',
            'jsonType' => 'Unsigned Integer'
        ]));

        $this->addField(new TypeField([
            'name' => 'LastLedgerSequence',
            'description' => 'Highest ledger index this transaction can appear in. Specifying this field places a strict upper limit on how long the transaction can wait to be validated or rejected.',
            'jsonType' => 'Number'
        ]));

        $this->addField(new TypeField([
            'name' => 'Memos',
            'description' => 'Additional arbitrary information used to identify this transaction.',
            'jsonType' => 'Array'
        ]));

        $this->addField(new TypeField([
            'name' => 'Signers',
            'description' => 'Array of objects that represent a multi-signature which authorizes this transaction.',
            'jsonType' => 'Array'
        ]));

        $this->addField(new TypeField([
            'name' => 'SourceTag',
            'description' => 'Arbitrary integer used to identify the reason for this payment, or a sender on whose behalf this transaction is made.',
            'jsonType' => 'Unsigned Integer'
        ]));

        $this->addField(new TypeField([
            'name' => 'SignPubKey',
            'description' => 'Hex representation of the public key that corresponds to the private key used to sign this transaction.'
        ]));

        $this->addField(new TypeField([
            'name' => 'TxnSignature',
            'description' => 'The signature that verifies this transaction as originating from the account it says it is from.'
        ]));

        $this->addField(new TypeField([
            'name' => 'SigningPubKey',
            'description' => 'Public key the signature was signed with.'
        ]));
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
}
