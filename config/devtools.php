<?php

return [

    'enabled' => env('DEVTOOLS_ENABLED', env('APP_ENV') !== 'production'),

    'middleware' => [
        'web',
        'auth',
        'throttle:20,1',
    ],

    'allowed_environments' => [
        'local',
        'development',
        'staging',
    ],

    'prefix' => 'devtools',

    'show_output' => env('DEVTOOLS_SHOW_OUTPUT', true),

    'commands' => [
        'c' => [
            'command' => 'optimize:clear',
            'route' => 'optimize-clear',
        ],

        'm' => [
            'command' => 'migrate',
            'route' => 'migrate',
            'options' => [
                '--force' => true,
            ],
            'confirm' => true,
        ],

        's' => [
            'command' => 'storage:link',
            'route' => 'storage-link',
        ],

        'q' => [
            'command' => 'queue:restart',
            'route' => 'queue-restart',
        ],

        'r' => [
            'command' => 'route:clear',
            'route' => 'route-clear',
        ],

        'v' => [
            'command' => 'view:clear',
            'route' => 'view-clear',
        ],
    ],

];
