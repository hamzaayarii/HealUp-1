<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\EnsureUserIsProfessor;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
        'professor' => EnsureUserIsProfessor::class,
        'isAdmin' => IsAdmin::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
        $middleware->web(append: [
            \App\Http\Middleware\ThemeMiddleware::class,
            \App\Http\Middleware\RedirectAdminMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
