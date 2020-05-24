<?php

namespace PHPCAEP\Model\Shop;

use Chetkov\Money\Money;
use PHPCAEP\Model\Model;

/**
 * Class Product
 * @package PHPCAEP\Model\Shop
 */
class Product extends Model
{
    private string $name;
    private string $description;
    private string $vendorCode;
    private Money $price;

    /**
     * Product constructor.
     * @param string $name
     * @param string $description
     * @param string $vendorCode
     * @param Money $price
     */
    public function __construct(string $name, string $description, string $vendorCode, Money $price)
    {
        parent::__construct();
        $this->name = $name;
        $this->description = $description;
        $this->vendorCode = $vendorCode;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getVendorCode(): string
    {
        return $this->vendorCode;
    }

    /**
     * @return Money
     */
    public function getPrice(): Money
    {
        return $this->price;
    }
}
