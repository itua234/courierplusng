<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


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
});

// Tenant API Endpoints
Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/tenant/users', function () {
        // Example: Fetch all users from the tenant's database
        return \App\Models\User::all();
    });

    Route::get('/tenant/info', function () {
        return response()->json([
            'message' => 'This is a tenant API endpoint.',
            'tenant_id' => tenant('id'),
        ]);
    });

    // Route::post('/tenant/users', function (Illuminate\Http\Request $request) {
    //     $validated = $request->validate([
    //         'firstname' => 'required|string|max:255',
    //         'lastname' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $user = \App\Models\User::create([
    //         'firstname' => $validated['firstname'],
    //         'lastname' => $validated['lastname'],
    //         'email' => $validated['email'],
    //         'password' => bcrypt($validated['password']),
    //     ]);

    //     return response()->json(['message' => 'User created successfully!', 'user' => $user], 201);
    // });
});