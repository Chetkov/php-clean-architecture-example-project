<?php

use PHPCAEP\EntryPoint\Console\ProductCreationCommand;
use PHPCAEP\Infrastructure\Repository\InFile\ProductInFileRepository;
use PHPCAEP\UseCase\AdminPart\ProductCreationService;

require __DIR__ . '/../bootstrap.php';

$command = new ProductCreationCommand(
    new ProductCreationService(
        new ProductInFileRepository()
    )
);

$command->handle();