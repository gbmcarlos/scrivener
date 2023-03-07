<?php
/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 7/11/18
 * Time: 3:42 PM
 */

return [
    'name' => env('APP_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'https' => env('APP_HTTPS', false),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'fallback_locale' => env('FALLBACK_LOCALE', 'en_AE'),
    'available_locales' => env('AVAILABLE_LOCALES', 'en_AE'),
    'locale' => env('locale', 'en'),
    'release' => env('APP_RELEASE', 'latest'),
    'key' => env('APP_KEY'),
    'ga_id' => env('GA_ID'),
    'cipher' => 'AES-256-CBC',
    'providers' => [

        \App\ServiceProviders\RoutesServiceProvider::class,
        \App\ServiceProviders\CommandsServiceProviders::class,
        \App\ServiceProviders\ClientsServiceProvider::class,

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
    ]
];
