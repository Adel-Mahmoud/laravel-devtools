<?php

use Illuminate\Support\Facades\Route;
use Adel\DevTools\Http\Controllers\CommandController;

Route::middleware('web')->prefix('devtools')->group(function () {

    Route::post('/optimize-clear', [CommandController::class, 'optimizeClear']);
    Route::post('/migrate', [CommandController::class, 'migrate']);
    Route::post('/storage-link', [CommandController::class, 'storageLink']);
    Route::post('/queue-restart', [CommandController::class, 'queueRestart']);
    Route::post('/route-clear', [CommandController::class, 'routeClear']);
    Route::post('/view-clear', [CommandController::class, 'viewClear']);

});
