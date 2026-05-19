<?php

return [
    'enabled' => env('DEVTOOLS_ENABLED', true),

    'middleware' => [
        'web',
    ],

    'allowed_environments' => ['local', 'development', 'staging'],

    'commands' => [
        'c' => ['command' => 'optimize:clear', 'route' => '/optimize-clear'],
        'm' => ['command' => 'migrate', 'route' => '/migrate', 'options' => ['--force' => true]],
        's' => ['command' => 'storage:link', 'route' => '/storage-link'],
        'q' => ['command' => 'queue:restart', 'route' => '/queue-restart'],
        'r' => ['command' => 'route:clear', 'route' => '/route-clear'],
        'v' => ['command' => 'view:clear', 'route' => '/view-clear'],
    ],
];
