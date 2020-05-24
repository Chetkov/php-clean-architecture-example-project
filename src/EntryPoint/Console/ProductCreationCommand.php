<?php

namespace PHPCAEP\EntryPoint\Console;

use PHPCAEP\UseCase\AdminPart\ProductCreationService;

/**
 * Class ProductCreationCommand
 * @package PHPCAEP\EntryPoint\Console
 */
class ProductCreationCommand
{
    private ProductCreationService $productCreationService;

    /**
     * ProductCreationCommand constructor.
     * @param ProductCreationService $productCreationService
     */
    public function __construct(ProductCreationService $productCreationService)
    {
        $this->productCreationService = $productCreationService;
    }

    public function handle(): void
    {
        $productUid = $this->productCreationService->create([
            'name' => trim((string)readline('Название продукта: ')),
            'description' => trim((string)readline('Описание продукта: ')),
            'vendor_code' => trim((string)readline('Артикул: ')),
            'price' => [
                'value' => trim((string)readline('Цена за единицу: ')),
                'currency' => trim((string)readline('В какой валюте указана цена?: ')),
            ],
        ]);

        print "Товар создан! UID: $productUid" . PHP_EOL;
    }
}
