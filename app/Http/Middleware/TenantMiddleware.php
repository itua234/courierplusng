<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the request is for a tenant subdomain
        // You can use a regex or any other method to determine if it's a tenant request
        // For example, if your tenant subdomains are like tenant1.example.com, tenant2.example.com
        // You can extract the subdomain from the request host
        $host = $request->getHost(); // Get the subdomain/host
        $subdomain = explode('.', $host)[0]; // Extract the subdomain
        // Check if the host is in the central domains
        // This is where you would check if the host is a central domain

        // If the host is a central domain, skip tenant handling
        if (in_array($host, config('tenancy.central_domains', []))) {
            return $next($request);
        }
        
        $tenant = Tenant::where('name', $host)->first(); // Find tenant by name or subdomain

        if ($tenant) {
            // Switch the database connection to the tenant's database
            $this->setTenantDatabase($tenant->database);
            
            // Make tenant info accessible across the application
            app()->instance('tenant', $tenant);
            
            // Configure auth to use tenant connection
            Config::set('auth.providers.users.connection', 'tenant');
            
            // Bind the tenant to the service container
            app()->singleton('currentTenant', function() use ($tenant) {
                return $tenant;
            });
            
            // Set default database connection to tenant
            Config::set('database.default', 'tenant');
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
