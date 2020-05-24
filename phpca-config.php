<?php

return [
    // Директория в которую будут складываться файлы отчета
    'reports_dir' => __DIR__ . '/phpca-reports',

    // Анализ с учетом пакетов подключенных через composer
    'vendor_based_modules' => [
        'enabled' => false,
        'vendor_path' => __DIR__ . '/vendor',
        'excluded' => [
            // '/excluded/vendor/package/dir',
        ],
    ],

    // Общие для всех модулей ограничения
    'restrictions' => [
        // Включение/отключение обнаружения нарушений принципа ацикличности зависимостей.
        // 'check_acyclic_dependencies_principle' => true,

        // Включение/отключение обнаружения нарушений принципа устойчивых зависимостей.
        // 'check_stable_dependencies_principle' => true,

        // Максимально допустимое расстояние до главной диагонали.
        // Элемент может отсутствовать или быть null, в таком случае ограничения не будут применены.
        // 'max_allowable_distance' => 0.1,
    ],

    // Описание модулей и их ограничений
    'modules' => [
        [
            'name' => 'model',
            'roots' => [
                [
                    'path' => __DIR__ . '/src/Model',
                    'namespace' => 'PHPCAEP\Model',
                ],
                // Иногда, особенно в старых проектах, код логически относимый к одному модулю, разбросан по разным частям
                // системы. В таком случае можно указать в конфиге несколько корневых директорий и, т.о. отнести их содержимое
                // какому-то одному модулю.
                //
                // [
                //     'path' => '/path/to/module/first',
                //     'namespace' => 'Module\First',
                // ],
            ],
            //Директории или файлы, которые будут пропущены в процессе анализа
            'excluded' => [
                // '/path/to/First/Module/dir1',
                // '/path/to/First/Module/dir2',
            ],
            'restrictions' => [
                // Имеет приоритет над общей настройкой restrictions->max_allowable_distance
                // 'max_allowable_distance' => 0.1,

                // Список РАЗРЕШЕННЫХ исходящих зависимостей. Заполняется именами других модулей.
                // Может отсутствовать, быть [] или null, в таком случае никакие ограничения накладываться не будут.
                // Не должен содержать значений, перечисленных в элементе forbidden_dependencies!
                // 'allowed_dependencies' => ['SecondModule'],

                // Список ЗАПРЕЩЕННЫХ исходящих зависимостей. Заполняется именами других модулей.
                // Может отсутствовать, быть [] или null, в таком случае никакие ограничения накладываться не будут.
                // Не должен содержать значений, перечисленных в элементе allowed_dependencies!
                // 'forbidden_dependencies' => ['ThirdModule'],

                // Список публичных элементов модуля. Если отсутствует или пустой, все элементы считаются публичными.
                // Если не пустой, не перечисленные в списке элементы будут считаться приватными.
                // Не должен содержать элементов, перечисленных в private_elements!
                // 'public_elements' => [
                //     First\Module\FirstClass::class,
                //     First\Module\SecondClass::class,
                // ],

                // Список приватных элементов модуля. Если отсутствует или пустой, все элементы считаются публичными.
                // Не должен содержать элементов, перечисленных в public_elements!
                // 'private_elements' => [
                //     First\Module\FirstClass::class,
                //     First\Module\SecondClass::class,
                // ],
            ],
        ],
        [
            'name' => 'infrastructure',
            'roots' => [
                [
                    'path' => __DIR__ . '/src/Infrastructure',
                    'namespace' => 'PHPCAEP\Infrastructure',
                ],
            ],
        ],
        [
            'name' => 'services',
            'roots' => [
                [
                    'path' => __DIR__ . '/src/UseCase',
                    'namespace' => 'PHPCAEP\UseCase',
                ],
            ],
        ],
        [
            'name' => 'http-entry-points',
            'roots' => [
                [
                    'path' => __DIR__ . '/src/EntryPoint/Http',
                    'namespace' => 'PHPCAEP\EntryPoint\Http',
                ],
            ],
        ],
        [
            'name' => 'console-entry-points',
            'roots' => [
                [
                    'path' => __DIR__ . '/src/EntryPoint/Console',
                    'namespace' => 'PHPCAEP\EntryPoint\Console',
                ],
            ],
        ],
    ],
];
