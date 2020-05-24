<?php

namespace PHPCAEP\Model\User\Contact;

use PHPCAEP\Model\Collection\Collection;
use PHPCAEP\Model\Collection\InvalidCollectionElementException;

/**
 * Class ContactCollection
 * @package PHPCAEP\Model\User\Contact
 * @method Contact current()
 */
class ContactCollection extends Collection
{
    /**
     * @param mixed $element
     * @throws InvalidCollectionElementException
     */
    protected function validateElement($element): void
    {
        if (!$element instanceof Contact) {
            throw new InvalidCollectionElementException(get_class($element), Contact::class);
        }
    }
}
