<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::get('/', function () {
    return [
        'app' => 'Courier-Plus API',
        'version' => '1.0.0'
    ];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Central API Endpoints
Route::middleware('api')->group(function () {
    Route::get('/central/users', function () {
        // Example: Fetch all users from the central database
        return \App\Models\User::all();
    });

    Route::get('/central/info', function () {
        return response()->json(['message' => 'This is a central API endpoint.']);
    });

    Route::get('/posts', function () {
        return \App\Models\Post::all();
        return 'This is th posts page';
    });
});

// Tenant API Endpoints
// Route::middleware([
//     'api',
//     InitializeTenancyByDomain::class,
//     PreventAccessFromCentralDomains::class,
// ])->group(function () {
//     Route::get('/tenant/users', function () {
//         // Example: Fetch all users from the tenant's database
//         return \App\Models\User::all();
//     });

//     Route::get('/tenant/info', function () {
//         return response()->json([
//             'message' => 'This is a tenant API endpoint.',
//             'tenant_id' => tenant('id'),
//         ]);
//     });
// });