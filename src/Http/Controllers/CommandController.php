<?php

namespace Adel\DevTools\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function optimizeClear()
    {
        Artisan::call('optimize:clear');

        return response()->json([
            'success' => true,
            'message' => 'Optimize Clear Done'
        ]);
    }

    public function migrate()
    {
        Artisan::call('migrate', ['--force' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Migration Done'
        ]);
    }

    public function storageLink()
    {
        Artisan::call('storage:link');

        return response()->json([
            'success' => true,
            'message' => 'Storage Link Done'
        ]);
    }

    public function queueRestart()
    {
        Artisan::call('queue:restart');

        return response()->json([
            'success' => true,
            'message' => 'Queue Restart Done'
        ]);
    }

    public function routeClear()
    {
        Artisan::call('route:clear');

        return response()->json([
            'success' => true,
            'message' => 'Route Clear Done'
        ]);
    }

    public function viewClear()
    {
        Artisan::call('view:clear');

        return response()->json([
            'success' => true,
            'message' => 'View Clear Done'
        ]);
    }
}
