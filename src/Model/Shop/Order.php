<?php

namespace PHPCAEP\Model\Shop;

use Chetkov\Money\Exception\ExchangeRateWasNotFoundException;
use Chetkov\Money\Exception\OperationWithDifferentCurrenciesException;
use Chetkov\Money\Exception\RequiredParameterMissedException;
use Chetkov\Money\Money;
use PHPCAEP\Model\Location\Address;
use PHPCAEP\Model\Model;
use PHPCAEP\Model\User\Contact\Contact;
use PHPCAEP\Model\User\Contact\ContactCollection;
use PHPCAEP\Model\User\User;

/**
 * Class Order
 * @package PHPCAEP\Model\Shop
 */
class Order extends Model
{
    private User $owner;
    private Address $deliveryAddress;
    private ContactCollection $ownerContacts;
    private ItemCollection $items;
    private Status $status;

    /**
     * Order constructor.
     * @param User $owner
     * @param Address $deliveryAddress
     * @param Contact[] $ownerContacts
     */
    public function __construct(User $owner, Address $deliveryAddress, array $ownerContacts = [])
    {
        parent::__construct();
        $this->owner = $owner;
        $this->deliveryAddress = $deliveryAddress;
        $this->ownerContacts = new ContactCollection($ownerContacts);
        $this->items = new ItemCollection();
        $this->status = new Status();
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @return Address
     */
    public function getDeliveryAddress(): Address
    {
        return $this->deliveryAddress;
    }

    /**
     * @return ContactCollection
     */
    public function getOwnerContacts(): ContactCollection
    {
        return $this->ownerContacts;
    }

    /**
     * @return ItemCollection
     */
    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return Money
     */
    public function calculateAmount(): Money
    {
        $amount = null;
        foreach ($this->items as $item) {
            if (!$amount instanceof Money) {
                $amount = $item->getAmount();
                continue;
            }
            try {
                $amount = $amount->add($item->getAmount());
            } catch (ExchangeRateWasNotFoundException
            | OperationWithDifferentCurrenciesException
            | RequiredParameterMissedException $e) {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }
        }
        return $amount ?? Money::RUB();
    }
}
