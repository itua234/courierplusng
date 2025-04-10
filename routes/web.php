<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::group(['middleware' => ['guest']], function () {
    Route::get('/register', [AuthController::class, 'showSignupForm'])->name("register");
    Route::get('/login', [AuthController::class, 'showloginForm'])->name("login");

    Route::post('/register', [AuthController::class, 'register'])->name('user-signup');
    Route::post('/login', [AuthController::class, 'login'])->name('signin');
});

Route::group([
    'middleware' => ['auth']
], function () {
    Route::group([
        'prefix' => 'posts'
    ], function () {
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{id}', [PostController::class, 'show'])->name('posts.show');
        Route::delete('/{id}', [PostController::class, 'deletePost'])->name('posts.destroy');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group([
        'prefix' => 'admin'
    ], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        //Route::get('/users', [AdminController::class, 'getUser'])->name('admin.users');
        Route::get('/posts', [AdminController::class, 'getPosts'])->name('admin.posts');
        Route::get('/approve-user/{userId}', [AdminController::class, 'approveUser'])->name('admin.approve-user');
    });
});