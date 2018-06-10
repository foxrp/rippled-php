<?php

namespace XRPHP\Transaction;

class TransactionField
{
    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var string */
    private $jsonType = 'String';

    /** @var bool */
    private $required = false;

    /** @var bool */
    private $autoFillable = false;

    public function __construct(array $params = null)
    {
        if ($params === null) {
            return;
        }

        foreach ($params as $key => $val) {
            switch ($key) {
                case 'name':
                    $this->setName($val);
                    break;
                case 'description':
                    $this->setDescription($val);
                    break;
                case 'jsonType':
                    $this->setJsonType($val);
                    break;
                case 'required':
                    $this->setRequired($val);
                    break;
                case 'autoFillable':
                    $this->setAutoFillable($val);
                    break;
            }
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getJsonType(): string
    {
        return $this->jsonType;
    }

    /**
     * @param string $jsonType
     */
    public function setJsonType(string $jsonType): void
    {
        $this->jsonType = $jsonType;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    /**
     * @return bool
     */
    public function isAutoFillable(): bool
    {
        return $this->autoFillable;
    }

    /**
     * @param bool $autoFillable
     */
    public function setAutoFillable(bool $autoFillable): void
    {
        $this->autoFillable = $autoFillable;
    }
}
