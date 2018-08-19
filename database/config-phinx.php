<?php

require __DIR__ . '/../config/env.php';

return [
    'paths' => [
        'migrations' => __DIR__ . '/migrations',
    ],
    'migration_base_class' => '\App\Migrations\Migration',
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => 'mysql',
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASSWORD,
            'port' => DB_PORT,
        ],
    ],
];