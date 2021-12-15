<?php

return [

    'base_uri' => env('MS_CRM_BASE_URI', 'https://api.almobi.com.br'),
    'prefix' => env('MS_CRM_API_PREFIX', '/api'),

    'front_uri' => env('MS_HUB_FRONT_URI', 'https://develop.crm.nave.dev'),

    'redirects' => [
        'customers' => [
            'show' => '/customers/%s'
        ]
    ]
];
