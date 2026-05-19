<?php

namespace Adel\DevTools\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    private function run($command, $options = [])
    {
        Artisan::call($command, $options);
        return response()->json([
            'success' => true,
            'message' => $command . ' executed',
            'output' => Artisan::output(),
        ]);
    }

    public function handle(Request $request, string $commandKey)
    {
        $commands = config('devtools.commands');

        abort_unless(isset($commands[$commandKey]), 404);

        $cmd = $commands[$commandKey];

        return $this->run($cmd['command'], $cmd['options'] ?? []);
    }
}
