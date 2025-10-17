<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/persil/index', [PersilController::class, 'index'])
         ->name('persil.index');

Route::get('/auth', [AuthController::class, 'index']) //Route /auth method GET → Menampilkan halaman login.
		->name('auth.index');

Route::post('auth/login', [AuthController::class, 'login']) //Route /auth/login method POST → Memproses form login.
		->name('auth.login');

Route::get('dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');

Route::resource('warga', WargaController::class);
Route::resource('jenis_penggunaan', JenisPenggunaanController::class);
