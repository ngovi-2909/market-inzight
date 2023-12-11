<?php

use App\Http\Controllers\Management\EmailController;
use App\Http\Controllers\Management\ProxyController;
use App\Http\Controllers\Management\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NonAdmin\NonAdminEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
//SuperUser management
Route::middleware(['auth'])->group(function () {
    // User is authentication and has super-user role
    Route::resource('/users', UserController::class);
    Route::resource('/emails', EmailController::class);
    Route::resource('/proxies', ProxyController::class);
});

//Authentication
Route::get('/login', [HomeController::class, 'getLogin'])->name('login');
Route::post('/login', [HomeController::class, 'login'])->name('login.post');
Route::get('/register', [HomeController::class, 'getSignup'])->name('register');
Route::post('/register', [HomeController::class, 'signup'])->name('register.post');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

