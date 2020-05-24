<?php

namespace PHPCAEP\Model\User\Contact;

/**
 * Class Contact
 * @package PHPCAEP\Model\User\Contact
 */
abstract class Contact
{
    private string $value;

    /**
     * Contact constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    abstract public function getType(): string;

    /**
     * @param string $value
     * @throws InvalidContactException|\RuntimeException
     */
    abstract protected function validate(string $value): void;
}
