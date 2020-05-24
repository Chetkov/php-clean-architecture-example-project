<?php

use PHPCAEP\EntryPoint\Http\OfficeController;
use PHPCAEP\Infrastructure\Repository\InFile\UserInFileRepository;
use PHPCAEP\UseCase\CustomerPart\Office\PasswordChangingService;

require __DIR__ . '/../bootstrap.php';

$controller = new OfficeController();
$passwordChangingService = new PasswordChangingService(new UserInFileRepository());

$controller->changePassword($passwordChangingService, [
    'login' => trim((string)readline('Логин: ')),
    'password' => trim((string)readline('Пароль: ')),
    'new_password' => trim((string)readline('Новый пароль: ')),
]);