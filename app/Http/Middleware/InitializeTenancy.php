<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stancl\Tenancy\Facades\Tenancy;

class InitializeTenancy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('X-Tenant')) {
            $tenant = Tenant::where('id', $request->header('X-Tenant'))->first();
            if ($tenant) {
                Tenancy::initialize($tenant);
            }
        }

        return $next($request);
    }
}
