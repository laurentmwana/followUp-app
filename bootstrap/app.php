<?php

use Illuminate\Http\Response;
use Illuminate\Foundation\Application;
use App\Http\Middleware\GrantAccessAdmin;
use App\Http\Middleware\GrantAccessStudent;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Psr\Http\Message\ResponseInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => GrantAccessAdmin::class,
            'student' => GrantAccessStudent::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {})->create();
