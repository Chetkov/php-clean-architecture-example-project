<?php

namespace PHPCAEP\Infrastructure\Repository\InFile;

use PHPCAEP\Model\Shop\Product;
use PHPCAEP\Model\Shop\ProductRepositoryInterface;

/**
 * Class ProductInFileRepository
 * @package PHPCAEP\Infrastructure\Repository\InFile
 * @method save(Product $model)
 * @method Product|null find(string $uid)
 * @method Product get(string $uid)
 */
class ProductInFileRepository extends AbstractInFileRepository implements ProductRepositoryInterface
{
    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Product::class;
    }
}
