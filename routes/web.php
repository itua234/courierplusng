<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TenantController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => []], function () {
    Route::group([
        'prefix' => 'admin'
    ], function () {
        Route::get('/', function () {
            return 'welcome to admin page';
        });
        Route::get('/posts', function () {
            return \App\Models\Post::all();
            return 'This is the posts page';
        });
        Route::get('/create-tenant', [AdminController::class, 'createTenant']);
        // Route::get('/', [AdminController::class, 'index']);
        // Route::get('/users', [AdminController::class, 'fetchUsers']);
        // Route::get('/posts', [AdminController::class, 'fetchPosts']);
    });
});