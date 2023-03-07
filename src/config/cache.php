<?php

return [
    'default' => env('CACHE_DRIVER', 'file'),
    'stores' => [
        'file' => [
            'driver' => 'array',
            'path' => storage_path('framework/cache/data')
        ],
        'redis' => [
            'client' => 'predis',
            'driver' => 'redis',
            'connection' => 'redis'
        ]
    ],
    'prefix' => env(
        'CACHE_PREFIX',
        env('APP_NAME', 'laravel') . '_cache'
    )
];
