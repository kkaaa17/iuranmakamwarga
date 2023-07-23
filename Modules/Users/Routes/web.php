<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersController;

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

Route::prefix('users')->middleware('auth')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::post('/show', [UsersController::class, 'show']);
    Route::post('/edit', [UsersController::class, 'edit']);
    Route::post('/store', [UsersController::class, 'store']);
    Route::post('/update', [UsersController::class, 'update']);
    Route::post('/recycle', [UsersController::class, 'recycle']);
    Route::post('/destroy', [UsersController::class, 'destroy']);
});
