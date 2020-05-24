<?php

namespace PHPCAEP\Model\Shop;

use PHPCAEP\Model\Collection\Collection;
use PHPCAEP\Model\Collection\InvalidCollectionElementException;

/**
 * Class OrderCollection
 * @package PHPCAEP\Model\Shop
 * @method Order current()
 */
class OrderCollection extends Collection
{
    /**
     * @inheritDoc
     */
    protected function validateElement($element): void
    {
        if (!$element instanceof Order) {
            throw new InvalidCollectionElementException(get_class($element), Order::class);
        }
    }
}
