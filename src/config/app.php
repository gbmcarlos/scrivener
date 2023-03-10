<?php
/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 7/11/18
 * Time: 3:42 PM
 */

return [
    'name' => env('APP_NAME', 'lumen'),
    'debug' => env('APP_DEBUG', false),
    'env' => env('APP_ENV', 'production'),
    'timezone' => env('TZ', 'UTC') ?: 'UTC',
    'fallback_locale' => env('FALLBACK_LOCALE', 'en_US'),
    'available_locales' => env('AVAILABLE_LOCALES', 'en_US'),
    'release' => env('APP_RELEASE', 'latest'),
    'key' => env('APP_KEY'),
    'cipher' => env('APP_CIPHER', 'AES-256-CBC'),
    'providers' => [

        \App\ServiceProviders\CommandsServiceProviders::class,
        \App\ServiceProviders\ClientsServiceProvider::class,

        /*
         * Crossbow service providers
         */
        Illuminate\Redis\RedisServiceProvider::class,
    ]
];
