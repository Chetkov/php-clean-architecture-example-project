<?php

use PHPCAEP\EntryPoint\Http\OfficeController;
use PHPCAEP\Infrastructure\Notification\Email\EmailNotifier;
use PHPCAEP\Infrastructure\Notification\NotifierAggregator;
use PHPCAEP\Infrastructure\Notification\Sms\SmsNotifier;
use PHPCAEP\Infrastructure\Repository\InFile\UserInFileRepository;
use PHPCAEP\UseCase\CustomerPart\Office\UserRegistrationService;

require __DIR__ . '/../bootstrap.php';

$controller = new OfficeController();
$userRegistrationService = new UserRegistrationService(
    new UserInFileRepository(),
    new NotifierAggregator(...[new EmailNotifier(), new SmsNotifier()])
);

$response = $controller->register($userRegistrationService, [
    'login' => trim((string)readline('Логин: ')),
    'password' => trim((string)readline('Пароль: ')),
    'first_name' => trim((string)readline('Имя: ')),
    'last_name' => trim((string)readline('Фамилия: ')),
    'middle_name' => trim((string)readline('Отчество: ')),
    'country' => trim((string)readline('Страна: ')),
    'city' => trim((string)readline('Город: ')),
    'street' => trim((string)readline('Улица: ')),
    'house' => trim((string)readline('Дом: ')),
    'flat' => trim((string)readline('Квартира: ')),
    'contacts' => [
        [
            'type' => 'email',
            'contact' => trim((string)readline('Email адрес: ')),
        ],
        [
            'type' => 'phone',
            'contact' => trim((string)readline('Номер телефона (XXXXXXXXXXX): ')),
        ]
    ],
]);

echo 'Ответ: ' . json_encode($response, JSON_THROW_ON_ERROR) . PHP_EOL;