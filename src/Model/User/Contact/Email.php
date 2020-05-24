<?php

namespace PHPCAEP\Model\User\Contact;

/**
 * Class Email
 * @package PHPCAEP\Model\User\Contact
 */
class Email extends Contact
{
    private const TYPE = 'email';

    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * @inheritDoc
     */
    protected function validate(string $value): void
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidContactException("$value is not a valid email!");
        }
    }
}
