<?php

return [
    'base_uri' => env('MS_CRM_BASE_URI', 'https://crm-server.nave.dev.br'),
    'prefix' => env('MS_CRM_API_PREFIX', '/api'),

    'front_uri' => env('MS_HUB_FRONT_URI', 'https://crm.nave.dev.br'),

    'redirects' => [
        'customers' => [
            'show' => '/customers/%s',
        ],
    ],

    'db' => [
        'url' => env('MS_CRM_DB_URL'),
        'host' => env('MS_CRM_DB_HOST'),
        'port' => env('MS_CRM_DB_PORT'),
        'database' => env('MS_CRM_DB_DATABASE'),
        'username' => env('MS_CRM_DB_USERNAME'),
        'password' => env('MS_CRM_DB_PASSWORD'),
    ],
];
