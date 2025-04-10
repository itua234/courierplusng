<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api',
        //apiVersionPrefix: 'v{version}', // Enable versioning
        //commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        // using: function () {
        //     $centralDomains = config('tenancy.central_domains');
        //     $namespace = 'App\\Http\\Controllers'; // Define the namespace explicitly
    
        //     foreach ($centralDomains as $domain) {
        //         Route::middleware('web')
        //         ->domain($domain)
        //         ->namespace($namespace)
        //         ->group(base_path('routes/web.php'));
        //     }

        //     foreach ($centralDomains as $domain) {
        //         Route::prefix('api')
        //         ->middleware('api')
        //         ->domain($domain)
        //         ->namespace($namespace)
        //         ->group(base_path('routes/api.php'));
        //     }
    
        //     Route::middleware('web')->group(base_path('routes/tenant.php'));
        // }
        // apiVersion: 'v1',
        // apiMiddleware: 'api',
        // apiVersionMiddleware: 'api.version',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'tenant' => \App\Http\Middleware\TenantMiddleware::class
        ]);
        $middleware->validateCsrfTokens(except: [
            'posts/store',
            'posts/*',
            // 'http://127.0.0.1:8000/posts/*',
            // //'http://example.com/foo/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
