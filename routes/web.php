<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [AuthController::class, 'showSignupForm'])->name("register");
Route::post('/register', [AuthController::class, 'register'])->name('user-signup');
// Route::group(['middleware' => ['tenant']], function () {
//     Route::group([
//         'prefix' => ''
//     ], function () {
//         Route::get('/', function () {
//             //return app('tenant');
//             //return \App\Models\User::all();
//         });
//     });
// });

Route::group(['middleware' => []], function () {
    Route::group([
        'prefix' => 'admin'
    ], function () {
        Route::get('/', function () {
            return view('welcome');
        });
        //Route::get('/', [AdminController::class, 'index']);
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