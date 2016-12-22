<?php
return [
    'settings' => [
        // Slim settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'smarty' => [
                'cacheDir' => __DIR__ . '/../cache/smarty/cache',
                'compileDir' => __DIR__ . '/../cache/smarty/compile',
            ],
        ],

        // Doctrine
        'doctrine' => [
            'model' => __DIR__ . '/src/Model',
            'cache_proxy' => __DIR__ . '/../cache/doctrine'
        ],

        // DB Conection
        'db' => [
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'root',
            'dbname'   => 'pagaoseguro'
        ],

        // Security configs
        'security' => [
            'aesKey' => 's3cUrityK3ys3cUrityK3ys3cUrityK3',
            'hashids' => [
                'minLen' => 9,
                'salt' => 'P@gaoS3gSalt',
                'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
            ]
        ],
    ],
];
