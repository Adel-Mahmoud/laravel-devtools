<?php

namespace Adel\DevTools;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Adel\DevTools\Commands\InstallDevToolsCommand;

class DevToolsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/devtools.php', 'devtools');
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'devtools');

        $this->publishes([
            __DIR__ . '/../config/devtools.php' => config_path('devtools.php'),
        ], 'devtools-config');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/devtools'),
        ], 'devtools-views');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallDevToolsCommand::class,
            ]);
        }

        Blade::directive('devtoolsScript', function () {
            return "<?php echo view('devtools::script')->render(); ?>";
        });
    }
}
