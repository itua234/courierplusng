<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return \App\Models\User::all();
        dd(\App\Models\User::all()->toArray());
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});

// Route::get('/posts', function () {
    //     dd([
    //         'tenant_id' => tenant('id'),
    //         'db' => DB::connection()->getDatabaseName(),
    //         'users' => \App\Models\User::all()
    //     ]);
    //     // dd(\App\Models\User::all());
    //     // return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    // });