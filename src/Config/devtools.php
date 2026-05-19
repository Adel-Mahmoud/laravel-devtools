<?php

return [
    'enabled' => env('DEVTOOLS_ENABLED', true),

    'middleware' => [
        'web',
    ],

    'commands' => [
        'c' => [
            'command' => 'optimize:clear',
            'method' => 'POST',
            'route' => '/optimize-clear',
            'label' => 'Optimize Clear',
        ],
        'm' => [
            'command' => 'migrate',
            'method' => 'POST',
            'route' => '/migrate',
            'label' => 'Migration',
            'options' => ['--force' => true],
        ],
        's' => [
            'command' => 'storage:link',
            'method' => 'POST',
            'route' => '/storage-link',
            'label' => 'Storage Link',
        ],
        'q' => [
            'command' => 'queue:restart',
            'method' => 'POST',
            'route' => '/queue-restart',
            'label' => 'Queue Restart',
        ],
        'r' => [
            'command' => 'route:clear',
            'method' => 'POST',
            'route' => '/route-clear',
            'label' => 'Route Clear',
        ],
        'v' => [
            'command' => 'view:clear',
            'method' => 'POST',
            'route' => '/view-clear',
            'label' => 'View Clear',
        ],
    ],

    'toast' => [
        'duration' => 2000,
        'position' => 'bottom-right',
        'success_color' => '#16a34a',
        'error_color' => '#dc2626',
    ],

    'allowed_environments' => ['local', 'development', 'staging'],
];
