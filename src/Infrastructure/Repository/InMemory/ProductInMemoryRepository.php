<?php

namespace PHPCAEP\Infrastructure\Repository\InMemory;

use PHPCAEP\Model\Shop\Product;
use PHPCAEP\Model\Shop\ProductRepositoryInterface;

/**
 * Class ProductInMemoryRepository
 * @package PHPCAEP\Infrastructure\Repository\InMemory
 * @method save(Product $model)
 * @method Product|null find(string $uid)
 * @method Product get(string $uid)
 */
class ProductInMemoryRepository extends AbstractInMemoryRepository implements ProductRepositoryInterface
{
    protected function getModelClass(): string
    {
        return Product::class;
    }
}
