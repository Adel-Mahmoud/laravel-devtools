<?php

namespace Adel\DevTools\Commands;

use Illuminate\Console\Command;

class InstallDevToolsCommand extends Command
{
    protected $signature = 'devtools:install';
    protected $description = 'Install DevTools package';

    public function handle()
    {
        $this->info('Installing DevTools...');

        $this->call('vendor:publish', [
            '--tag' => 'devtools-config',
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'devtools-views',
        ]);

        $this->info('DevTools installed successfully.');
        $this->info('Add @devtoolsScript before </body>');
    }
}
