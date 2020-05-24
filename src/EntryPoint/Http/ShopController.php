<?php

namespace PHPCAEP\EntryPoint\Http;

use PHPCAEP\UseCase\CustomerPart\Shop\OrderBookingService;

/**
 * Class ShopController
 * @package PHPCAEP\EntryPoint\Http
 */
class ShopController
{
    /**
     * @param OrderBookingService $service
     * @param array $request
     * @return array
     */
    public function bookOrder(OrderBookingService $service, array $request): array
    {
        $orderUid = $service->book($request);
        return [
            'uid' => $orderUid
        ];
    }
}
