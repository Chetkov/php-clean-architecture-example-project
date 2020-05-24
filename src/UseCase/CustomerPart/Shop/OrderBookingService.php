<?php

namespace PHPCAEP\UseCase\CustomerPart\Shop;

use PHPCAEP\Model\Location\Address;
use PHPCAEP\Model\Shop\Item;
use PHPCAEP\Model\Shop\Order;
use PHPCAEP\Model\Shop\OrderRepositoryInterface;
use PHPCAEP\Model\Shop\ProductRepositoryInterface;
use PHPCAEP\Model\User\Contact\Email;
use PHPCAEP\Model\User\Contact\Phone;
use PHPCAEP\Model\User\User;
use PHPCAEP\Model\User\UserRepositoryInterface;
use PHPCAEP\UseCase\CommonService\Notification\NotifierInterface;

/**
 * Class OrderBookingService
 * @package PHPCAEP\UseCase\CustomerPart\Shop
 */
class OrderBookingService
{
    private UserRepositoryInterface $userRepository;
    private ProductRepositoryInterface $productRepository;
    private OrderRepositoryInterface $orderRepository;
    private NotifierInterface $notifier;

    /**
     * OrderCreationService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param ProductRepositoryInterface $productRepository
     * @param OrderRepositoryInterface $orderRepository
     * @param NotifierInterface $notifier
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        NotifierInterface $notifier
    ) {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->notifier = $notifier;
    }

    /**
     * @param array $request
     * @return string order uid
     */
    public function book(array $request): string
    {
        $login = $request['credential']['login'];
        $password = $request['credential']['password'];
        $user = $this->userRepository->getByCredential($login, User::hashPassword($password));

        $order = new Order($user, new Address(
            $request['delivery_address']['country'],
            $request['delivery_address']['city'],
            $request['delivery_address']['street'],
            $request['delivery_address']['house'],
            $request['delivery_address']['flat']
        ));

        $ownerContacts = $order->getOwnerContacts();
        foreach ($request['owner_contacts'] as $contact) {
            switch ($contact['type']) {
                case 'email':
                    $ownerContacts->add(new Email($contact['contact']));
                    break;
                case 'phone':
                    $ownerContacts->add(new Phone($contact['contact']));
                    break;
                default:
                    throw new \RuntimeException(sprintf('Unsupported contact type %s', $contact['type']));
            }
        }

        $orderItems = $order->getItems();
        foreach ($request['items'] as $item) {
            $orderItems->add(new Item(
                $this->productRepository->get($item['product_uid']),
                $item['quantity']
            ));
        }

        $this->orderRepository->save($order);
        $this->notifyAboutBooking($order);

        return $order->getUid();
    }

    /**
     * @param Order $order
     */
    private function notifyAboutBooking(Order $order): void
    {
        foreach ($order->getOwnerContacts() as $contact) {
            $this->notifier->notify($contact, "{$order->getOwner()->getFio()->getFirstName()}, Спасибо за заказ! UID: {$order->getUid()}");
        }
    }
}
