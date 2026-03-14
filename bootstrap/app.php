<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ExternalAuthMiddleware;
use App\Http\Middleware\EnsureOtpRequested;
use App\Http\Middleware\EnsureOtpVerified;
use App\Http\Middleware\CheckRoleOrSuperAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
         $middleware->alias([
            'external.auth' => ExternalAuthMiddleware::class,
            'otp.requested' => EnsureOtpRequested::class,
            'otp.verified' => EnsureOtpVerified::class,
            'role'   =>        CheckRoleOrSuperAdmin::class,
            //'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
