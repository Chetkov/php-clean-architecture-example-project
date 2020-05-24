<?php

namespace PHPCAEP\Model\Shop;

use Chetkov\Money\Exception\RequiredParameterMissedException;
use Chetkov\Money\Money;

/**
 * Class Item
 * @package PHPCAEP\Model\Shop
 */
class Item
{
    private Product $product;
    private int $quantity;
    private Money $productPrice;
    private Money $amount;

    /**
     * Item constructor.
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->productPrice = $product->getPrice();
        try {
            $this->amount = $product->getPrice()->multiple($quantity);
        } catch (RequiredParameterMissedException $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return Money
     */
    public function getProductPrice(): Money
    {
        return $this->productPrice;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }
}
