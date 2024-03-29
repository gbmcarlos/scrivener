<?php

return [
    'driver' => env('SESSION_DRIVER', 'file'),
    'lifetime' => env('SESSION_LIFETIME', 120),
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => storage_path('framework/sessions'),
    'connection' => 'redis',
    'table' => 'sessions',
    'store' => null,
    'lottery' => [2, 100],
    'cookie' => env(
        'SESSION_COOKIE',
        env('APP_NAME', 'laravel') . '_session'
    ),
    'path' => '/',
    'domain' => env('SESSION_DOMAIN', null),
    'secure' => env('SESSION_SECURE_COOKIE', false),
    'http_only' => true,
    'same_site' => null
];
