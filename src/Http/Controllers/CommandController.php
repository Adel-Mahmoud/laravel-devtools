<?php

namespace Adel\DevTools\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    protected function runCommand(string $command, array $options = []): JsonResponse
    {
        try {
            Artisan::call($command, $options);
            $output = Artisan::output();

            return response()->json([
                'success' => true,
                'message' => $command . ' executed',
                'output' => $output,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function handleCommand(Request $request, string $commandKey): JsonResponse
    {
        $commands = config('devtools.commands');

        if (!isset($commands[$commandKey])) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        return $this->runCommand($commands[$commandKey]['command'], $commands[$commandKey]['options'] ?? []);
    }
}
