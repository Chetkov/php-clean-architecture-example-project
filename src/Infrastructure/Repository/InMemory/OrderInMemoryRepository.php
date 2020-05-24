<?php

namespace PHPCAEP\Infrastructure\Repository\InMemory;

use PHPCAEP\Model\Shop\Order;
use PHPCAEP\Model\Shop\OrderRepositoryInterface;

/**
 * Class OrderInMemoryRepository
 * @package PHPCAEP\Infrastructure\Repository\InMemory
 * @method save(Order $model)
 * @method Order|null find(string $uid)
 * @method Order get(string $uid)
 */
class OrderInMemoryRepository extends AbstractInMemoryRepository implements OrderRepositoryInterface
{
    protected function getModelClass(): string
    {
        return Order::class;
    }
}
