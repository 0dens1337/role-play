<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EnsureInviteValidated;
use App\Http\Middleware\HasTokenInCookie;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->prepend(HandleCors::class);
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'checkToken' => HasTokenInCookie::class,
            'checkInviteCode' => EnsureInviteValidated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
