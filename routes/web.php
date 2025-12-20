<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetaPersilController;
use App\Http\Controllers\DokumenPersilController;
use App\Http\Controllers\SengketaPersilController;
use App\Http\Controllers\JenisPenggunaanController;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/tes', function () {
    return response()->json(['ok' => true]);
});
Route::get('auth', [AuthController::class, 'login'])->name('login');
Route::get('auth/register', [AuthController::class, 'register'])->name('regis');
Route::post('auth/authentication', [AuthController::class, 'authentication'])->name('login.auth');
Route::post('auth/registration', [AuthController::class, 'registration'])->name('regis.regis');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('about', [AuthController::class, 'about'])->name('about');
Route::get('aboutme', [AuthController::class, 'aboutme'])->name('aboutme');
Route::get('/persil/search', [PersilController::class, 'search'])->name('persil.search');

Route::group(['middleware'=>['checkislogin']],function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('jenis_penggunaan', JenisPenggunaanController::class);
Route::group(['middleware'=>['checkrole:Admin,Staff']],function(){
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
    Route::put('/users/{id}/photo', [UserController::class, 'updatePhoto'])->name('user.update.photo');
    Route::delete('/users/{id}/photo', [UserController::class, 'deletePhoto'])->name('user.delete.photo');
    Route::resource('persil', PersilController::class);
    Route::resource('media', MediaController::class);
    Route::resource('dokumen_persil', DokumenPersilController::class);
    Route::resource('sengketa_persil', SengketaPersilController::class);
    Route::resource('peta_persil', PetaPersilController::class);
    Route::delete('/persil/media/{media}', [PersilController::class, 'deleteMedia'])
        ->name('persil.media.delete');
    });
});
