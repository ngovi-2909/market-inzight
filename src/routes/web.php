<?php

use Illuminate\Support\Facades\Route;
use mi\crud\Http\Controllers\HomeController;
use mi\crud\Http\Controllers\Management\EmailController;
use mi\crud\Http\Controllers\Management\ProxyController;
use mi\crud\Http\Controllers\Management\UserController;


Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('web');

////SuperUser management
Route::middleware(['web'])->group(function () {
    // User is authentication and has admin role
    Route::resource('/users', UserController::class);
    Route::resource('/emails', EmailController::class);
    Route::resource('/proxies', ProxyController::class);
});


//Authentication
Route::get('/login', [HomeController::class, 'getLogin'])->name('login')->middleware('web');
Route::post('/login', [HomeController::class, 'login'])->name('login.post')->middleware('web');
Route::get('/register', [HomeController::class, 'getSignup'])->name('register');
Route::post('/register', [HomeController::class, 'signup'])->name('register.post');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
