<?php

use Illuminate\Support\Facades\Route;
use Adel\DevTools\Http\Controllers\CommandController;
use Adel\DevTools\Http\Middleware\AuthorizeDevTools;

Route::middleware(array_merge(config('devtools.middleware'), [AuthorizeDevTools::class]))
    ->prefix('devtools')
    ->group(function () {

        foreach (config('devtools.commands') as $key => $cmd) {
            Route::post($cmd['route'], [CommandController::class, 'handleCommand'])
                ->defaults('commandKey', $key);
        }
    });
