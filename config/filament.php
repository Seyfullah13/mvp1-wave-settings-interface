<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Broadcasting
    |--------------------------------------------------------------------------
    |
    | By uncommenting the Laravel Echo configuration, you may connect Filament
    | to any Pusher-compatible websockets server.
    |
    | This will allow your users to receive real-time notifications.
    |
     */

    'broadcasting' => [

        // 'echo' => [
        //     'broadcaster' => 'pusher',
        //     'key' => env('VITE_PUSHER_APP_KEY'),
        //     'cluster' => env('VITE_PUSHER_APP_CLUSTER'),
        //     'wsHost' => env('VITE_PUSHER_HOST'),
        //     'wsPort' => env('VITE_PUSHER_PORT'),
        //     'wssPort' => env('VITE_PUSHER_PORT'),
        //     'authEndpoint' => '/api/v1/broadcasting/auth',
        //     'disableStats' => true,
        //     'encrypted' => true,
        //     'forceTLS' => true,
        // ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | This is the storage disk Filament will use to store files. You may use
    | any of the disks defined in the `config/filesystems.php`.
    |
     */

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Assets Path
    |--------------------------------------------------------------------------
    |
    | This is the directory where Filament's assets will be published to. It
    | is relative to the `public` directory of your Laravel application.
    |
    | After changing the path, you should run `php artisan filament:assets`.
    |
     */

    'assets_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Cache Path
    |--------------------------------------------------------------------------
    |
    | This is the directory that Filament will use to store cache files that
    | are used to optimize the registration of components.
    |
    | After changing the path, you should run `php artisan filament:cache-components`.
    |
     */

    'cache_path' => base_path('bootstrap/cache/filament'),

    /*
    |--------------------------------------------------------------------------
    | Livewire Loading Delay
    |--------------------------------------------------------------------------
    |
    | This sets the delay before loading indicators appear.
    |
    | Setting this to 'none' makes indicators appear immediately, which can be
    | desirable for high-latency connections. Setting it to 'default' applies
    | Livewire's standard 200ms delay.
    |
     */

    'livewire_loading_delay' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Panels Configuration
    |--------------------------------------------------------------------------
    |
    | This is where you can define the different panels for your application.
    | Ensure that you configure at least one panel.
    |
     */

    'panels' => [
        'admin' => [
            'id' => 'admin', // Identifiant unique du panneau
            'path' => '/filament-api', // Nouveau chemin pour le panneau Filament
            'resources' => [
                App\Filament\Resources\ApiKeyResource::class,
            ],
            'pages' => [],
            'widgets' => [],
            'permissions' => [],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Panel
    |--------------------------------------------------------------------------
    |
    | This setting defines the default panel Filament should use.
    |
     */

    'default_panel' => 'admin', // Nom du panneau par défaut

    'navigation' => [
        App\Filament\Resources\ApiKeyResource::class, // Ajout de la ressource à la navigation
    ],

];