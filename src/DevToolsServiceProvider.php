<?php

namespace Adel\DevTools;

use Illuminate\Support\ServiceProvider;

class DevToolsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'devtools');

        $this->publishes([
            __DIR__ . '/resources/views/script.blade.php' => resource_path('views/vendor/devtools/script.blade.php'),
        ], 'devtools-views');
    }
}
