<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersilController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PersilController::class, 'index']);
