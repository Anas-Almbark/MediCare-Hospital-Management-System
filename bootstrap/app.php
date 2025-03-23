<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web([\App\Http\Middleware\Language::class]);
        $middleware->alias([
            'status_account' => \App\Http\Middleware\StatusAccount::class,
            "role" => \App\Http\Middleware\CheckRole::class,
            "userAccount" => \App\Http\Middleware\UserAccount::class,
        ]);
        $middleware->group('auth', [
            'status_account',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
