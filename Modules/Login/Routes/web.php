<?php

use Illuminate\Support\Facades\Route;
use Modules\Login\Http\Controllers\LoginController;

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

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/proses', [LoginController::class, 'authenticate']);
    Route::post('/logout', [LoginController::class, 'logout']);
});
