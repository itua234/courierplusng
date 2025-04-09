<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [AuthController::class, 'showSignupForm'])->name("register");
Route::post('/register', [AuthController::class, 'register'])->name('user-signup');
Route::get('/login', [AuthController::class, 'showloginForm'])->name("login");
Route::post('/login', [AuthController::class, 'login'])->name('signin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
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
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

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