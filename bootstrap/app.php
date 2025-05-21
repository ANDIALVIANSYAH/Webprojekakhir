<?php

use App\Http\Middleware\adminmiddleware;
use App\Http\Middleware\costumermiddleware;
use App\Http\Middleware\recepcionismiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin'=>adminmiddleware::class,
            'recepcionis'=>recepcionismiddleware::class,
            'costumer'=>costumermiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
