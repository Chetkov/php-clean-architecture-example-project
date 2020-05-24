<?php

use PHPCAEP\EntryPoint\Http\ShopController;
use PHPCAEP\Infrastructure\Notification\Email\EmailNotifier;
use PHPCAEP\Infrastructure\Notification\NotifierAggregator;
use PHPCAEP\Infrastructure\Notification\Sms\SmsNotifier;
use PHPCAEP\Infrastructure\Repository\InFile\OrderInFileRepository;
use PHPCAEP\Infrastructure\Repository\InFile\ProductInFileRepository;
use PHPCAEP\Infrastructure\Repository\InFile\UserInFileRepository;
use PHPCAEP\UseCase\CustomerPart\Shop\OrderBookingService;

require __DIR__ . '/../bootstrap.php';

$controller = new ShopController();
$orderBookingService = new OrderBookingService(
    new UserInFileRepository(),
    new ProductInFileRepository(),
    new OrderInFileRepository(),
    new NotifierAggregator(...[new EmailNotifier(), new SmsNotifier()])
);

$addItems = static function(): array {
    $items = [];
    while (true) {
        $items[] = [
            'product_uid' => trim((string)readline('UID продукта: ')),
            'quantity' => trim((string)readline('Количество: ')),
        ];

        $command = trim((string)readline('Для добавления ещё одной позиции нажмите Enter, иначе введите end: '));
        if ($command === 'end') {
            break;
        }
    }
    return $items;
};

$response = $controller->bookOrder($orderBookingService, [
    'credential' => [
        'login' => trim((string)readline('Логин: ')),
        'password' => trim((string)readline('Пароль: ')),
    ],
    'delivery_address' => [
        'country' => trim((string)readline('Страна (для доставки): ')),
        'city' => trim((string)readline('Город (для доставки): ')),
        'street' => trim((string)readline('Улица (для доставки): ')),
        'house' => trim((string)readline('Дом (для доставки): ')),
        'flat' => trim((string)readline('Квартира (для доставки): ')),
    ],
    'owner_contacts' => [
        [
            'type' => 'email',
            'contact' => trim((string)readline('Контактный email адрес: ')),
        ],
        [
            'type' => 'phone',
            'contact' => trim((string)readline('Контактный телефонный номер: ')),
        ]
    ],
    'items' => $addItems(),
]);

echo 'Response: ' . json_encode($response, JSON_THROW_ON_ERROR) . PHP_EOL;