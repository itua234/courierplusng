<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // apiVersion: 'v1',
        // apiMiddleware: 'api',
        // apiNamespace: 'App\\Http\\Controllers\\Api',
        // apiVersionMiddleware: 'api.version',
        // apiVersionPrefix: 'v{version}',
        // apiVersionNamespace: 'App\\Http\\Controllers\\Api\\V{version}',
        // apiVersionRoute: 'api.version',
        // apiVersionRoutePrefix: 'v{version}',
        // apiVersionRouteNamespace: 'App\\Http\\Controllers\\Api\\V{version}',
        // apiVersionRouteMiddleware: 'api.version',
        // apiVersionRoutePrefixMiddleware: 'api.version.prefix',
        // apiVersionRouteNamespaceMiddleware: 'api.version.namespace',
        // apiVersionRouteMiddlewarePrefix: 'api.version.middleware',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
