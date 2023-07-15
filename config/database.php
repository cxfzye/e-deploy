<?php
return [
    'default' => [
        'database_type' => 'mysql',
        'database_name' => env('DB_DATABASE', ''),
        'server' => env('DB_HOST', ''),
        'username' => env('DB_USERNAME',''),
        'password' => env('DB_PASSWORD', ''),
        'port' => env('DB_PORT', '3306'),
        'charset' => env('DB_CHARSET', 'utf8'),
    ],
];
