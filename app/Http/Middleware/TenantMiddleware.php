<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost(); // Get the subdomain/host
        $tenant = Tenant::where('name', $host)->first(); // Find tenant by name or subdomain

        if ($tenant) {
            // Switch database connection to the tenant's database
            DB::purge('mysql');
            config()->set('database.connections.mysql.database', $tenant->database);
            DB::reconnect('mysql');
        }

        return $next($request);
    }
}
