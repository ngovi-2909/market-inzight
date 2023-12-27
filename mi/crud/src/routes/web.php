<?php

use Illuminate\Support\Facades\Route;
use mi\crud\Http\Controllers\HomeController;
use mi\crud\Http\Controllers\Management\EmailController;
use mi\crud\Http\Controllers\Management\ProxyController;
use mi\crud\Http\Controllers\Management\UserController;


Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('web');

//Authentication
Route::get('/login', [HomeController::class, 'getLogin'])->name('login')->middleware('web');
Route::post('/login', [HomeController::class, 'login'])->name('login.post')->middleware('web');
Route::get('/register', [HomeController::class, 'getSignup'])->name('register')->middleware('web');
Route::post('/register', [HomeController::class, 'signup'])->name('register.post')->middleware('web');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout')->middleware('web');

// Emails import excel, delete all
Route::get('emails/import', [EmailController::class, 'importEmail'])->name('emails.importEmail')->middleware('web');
Route::post('emails/import', [EmailController::class, 'import'])->name('emails.import')->middleware('web');
Route::delete('emails/delete_all', [EmailController::class, 'deleteAll'])->name('emails.deleteAll')->middleware('web');

// Proxies import excel, delete all
Route::get('proxies/import', [ProxyController::class, 'importProxy'])->name('proxies.importProxy')->middleware('web');
Route::post('proxies/import', [ProxyController::class, 'import'])->name('proxies.import')->middleware('web');
Route::delete('proxies/delete_all', [ProxyController::class, 'deleteAll'])->name('proxies.deleteAll')->middleware('web');

// User Management
Route::middleware(['web'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/emails', EmailController::class);
    Route::resource('/proxies', ProxyController::class);
});

// Call for datatable
Route::get('users/api', [UserController::class, 'api'])->name('users.api');
Route::get('emails/api', [EmailController::class, 'api'])->name('emails.api');
Route::get('proxies/api', [ProxyController::class, 'api'])->name('proxies.api');


