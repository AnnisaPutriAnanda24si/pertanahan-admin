<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaanController;

// Route::get('/', function () {
//     return route('login');
// });

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('auth', [AuthController::class, 'login'])->name('login');
Route::get('auth/register', [AuthController::class, 'register'])->name('regis');
Route::post('auth/authentication', [AuthController::class, 'authentication'])->name('login.auth');
Route::post('auth/registration', [AuthController::class, 'registration'])->name('regis.regis');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('dashboard', [DashboardController::class, 'index'])
//          ->name('dashboard');

Route::group(['middleware'=>['checkislogin']],function(){
Route::group(['middleware'=>['checkrole:Admin, Super Admin']],function(){
Route::resource('warga', WargaController::class);
Route::resource('user', UserController::class);
Route::resource('persil', PersilController::class);
Route::resource('media', MediaController::class);
Route::delete('/persil/media/{media}', [PersilController::class, 'deleteMedia'])
     ->name('persil.media.delete');
});
Route::resource('jenis_penggunaan', JenisPenggunaanController::class);
});
