<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        //web: __DIR__.'/../routes/web.php',
        //api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {
            $centralDomains = config('tenancy.central_domains');
            $namespace = 'App\\Http\\Controllers'; // Define the namespace explicitly
    
            foreach ($centralDomains as $domain) {
                Route::middleware('web')
                    ->domain($domain)
                    ->namespace($namespace)
                    ->group(base_path('routes/web.php'));
            }

            foreach ($centralDomains as $domain) {
                    Route::prefix('api')
                    ->middleware('api')
                    ->domain($domain)
                    ->namespace($namespace)
                    ->group(base_path('routes/api.php'));
            }
    
            Route::middleware('web')->group(base_path('routes/tenant.php'));
        }
        // apiVersion: 'v1',
        // apiMiddleware: 'api',
        // apiVersionMiddleware: 'api.version',
        // apiVersionPrefix: 'v{version}',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //\App\Http\Middleware\InitializeTenancy::class
        $middleware->alias([
            //'tenant' => \App\Http\Middleware\TenantMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
