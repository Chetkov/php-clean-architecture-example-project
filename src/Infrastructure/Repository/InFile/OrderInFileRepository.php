<?php

namespace PHPCAEP\Infrastructure\Repository\InFile;

use PHPCAEP\Model\Shop\Order;
use PHPCAEP\Model\Shop\OrderRepositoryInterface;

/**
 * Class OrderInFileRepository
 * @package PHPCAEP\Infrastructure\Repository\InFile
 * @method save(Order $model)
 * @method Order|null find(string $uid)
 * @method Order get(string $uid)
 */
class OrderInFileRepository extends AbstractInFileRepository implements OrderRepositoryInterface
{
    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Order::class;
    }
}
