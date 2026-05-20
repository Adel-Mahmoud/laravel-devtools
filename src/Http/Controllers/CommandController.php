<?php

namespace Adel\DevTools\Http\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class CommandController extends Controller
{
    private function runCommand(string $command, array $options = []): JsonResponse
    {
        try {

            Artisan::call($command, $options);

            Log::info('DevTools command executed', [
                'command' => $command,
                'user_id' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => $command . ' executed successfully.',
                'output' => config('devtools.show_output')
                    ? Artisan::output()
                    : null,
            ]);

        } catch (Throwable $e) {

            Log::error('DevTools command failed', [
                'command' => $command,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function handle(Request $request, string $commandKey): JsonResponse
    {
        $commands = config('devtools.commands', []);

        abort_unless(isset($commands[$commandKey]), 404);

        $cmd = $commands[$commandKey];

        return $this->runCommand(
            $cmd['command'],
            $cmd['options'] ?? []
        );
    }
}
