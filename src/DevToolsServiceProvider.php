<?php

namespace Adel\DevTools;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class DevToolsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'devtools');

        $this->publishes([
            __DIR__.'/Config/devtools.php' => config_path('devtools.php'),
        ], 'devtools-config');

        Blade::directive('devtoolsScript', function () {
            return "<?php echo view('devtools::script')->render(); ?>";
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/Config/devtools.php', 'devtools');
    }
}
