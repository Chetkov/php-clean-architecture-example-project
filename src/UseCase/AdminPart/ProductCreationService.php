<?php

namespace PHPCAEP\UseCase\AdminPart;

use Chetkov\Money\Money;
use PHPCAEP\Model\Shop\Product;
use PHPCAEP\Model\Shop\ProductRepositoryInterface;

/**
 * Class ProductCreationService
 * @package PHPCAEP\UseCase\AdminPart
 */
class ProductCreationService
{
    private ProductRepositoryInterface $productRepository;

    /**
     * ProductCreationService constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param array $request
     * @return string product uid
     */
    public function create(array $request): string
    {
        $product = new Product(
            $request['name'],
            $request['description'],
            $request['vendor_code'],
            new Money($request['price']['value'], $request['price']['currency'])
        );

        $this->productRepository->save($product);
        return $product->getUid();
    }
}
