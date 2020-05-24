<?php

namespace PHPCAEP\Model\Shop;

use PHPCAEP\Model\Collection\Collection;
use PHPCAEP\Model\Collection\InvalidCollectionElementException;

/**
 * Class ItemCollection
 * @package PHPCAEP\Model\Shop
 * @method Item current()
 */
class ItemCollection extends Collection
{
    /**
     * @inheritDoc
     */
    protected function validateElement($element): void
    {
        if (!$element instanceof Item) {
            throw new InvalidCollectionElementException(get_class($element), Item::class);
        }
    }
}
