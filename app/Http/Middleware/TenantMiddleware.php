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
        if (in_array($host, config('tenancy.central_domains', []))) {
            return $next($request);
        }
        // Check if the request is for a tenant subdomain
        // You can use a regex or any other method to determine if it's a tenant request
        // For example, if your tenant subdomains are like tenant1.example.com, tenant2.example.com
        // You can extract the subdomain from the request host
        $host = $request->getHost(); // Get the subdomain/host
        $tenant = Tenant::where('name', $host)->first(); // Find tenant by name or subdomain

        if ($tenant) {
            // Switch the database connection to the tenant's database
            $this->setTenantDatabase($tenant->database);
            // For MySQL you would use:
            //DB::statement("USE `{$tenant->database}`");
        } else {
            // Handle the case where the tenant is not found
            abort(404, 'Tenant not found');
        }

        return $next($request);
    }

    /**
     * Set the tenant's database connection dynamically.
     *
     * @param string $database
     * @return void
    */
    protected function setTenantDatabase(string $database): void
    {
        // Purge the current database connection
        DB::purge('tenant');
        // Set the tenant's database dynamically
        config()->set('database.connections.tenant.database', $database);
        // Reconnect to the database with the new configuration
        DB::reconnect('tenant');
    }
}
