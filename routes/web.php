<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('home.index');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login/store', [AuthController::class, 'loginStore'])->name('login.store');
    Route::post('/register/store', [AuthController::class, 'registerStore'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [PostsController::class, 'index'])->name('home.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/posts', [PostsController::class, 'myPosts'])->name('posts.index');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');

    Route::get('/posts/{slug}', [PostsController::class, 'view'])->name('posts.view');


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});