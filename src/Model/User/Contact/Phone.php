<?php

namespace PHPCAEP\Model\User\Contact;

/**
 * Class Phone
 * @package PHPCAEP\Model\User\Contact
 */
class Phone extends Contact
{
    private const TYPE = 'phone';

    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * @inheritDoc
     */
    protected function validate(string $value): void
    {
        preg_match('/^(?P<phone>[\d]{11})$/', $value, $matches);
        if (empty($matches['phone'])) {
            throw new InvalidContactException("$value is not a valid phone number!");
        }
    }
}
