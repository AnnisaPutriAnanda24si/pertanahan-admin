<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaanController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/persil/index', [PersilController::class, 'index'])
//          ->name('persil.index');

Route::get('/auth', [AuthController::class, 'login'])->name('login');
Route::get('/auth/register', [AuthController::class, 'register'])->name('regis');
Route::post('auth/authentication', [AuthController::class, 'authentication'])->name('login.auth');
Route::post('auth/registration', [AuthController::class, 'registration'])->name('regis.regis');

// Route::get('dashboard', [DashboardController::class, 'index'])
//          ->name('dashboard');

Route::resource('warga', WargaController::class);
Route::resource('jenis_penggunaan', JenisPenggunaanController::class);
Route::resource('user', UserController::class);
