<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PagesController::class, 'index'])->middleware('auth');
Route::get('dashboard2', [PagesController::class, 'index2']);
Route::get('dashboard3', [PagesController::class, 'index3']);
Route::get('datatables', [PagesController::class, 'datatables']);
