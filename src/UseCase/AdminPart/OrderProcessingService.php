<?php

namespace PHPCAEP\UseCase\AdminPart;

use PHPCAEP\Model\Shop\OrderRepositoryInterface;

/**
 * Class OrderProcessingService
 * @package PHPCAEP\UseCase\AdminPart
 */
class OrderProcessingService
{
    private OrderRepositoryInterface $orderRepository;

    /**
     * @param array $request
     */
    public function process(array $request): void
    {
        $order = $this->orderRepository->get($request['order_uid']);
        $order->getStatus()->toProcessed();
        $this->orderRepository->save($order);
    }

}
