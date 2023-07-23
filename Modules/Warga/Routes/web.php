<?php
use Modules\Warga\Http\Controllers\WargaController;

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

Route::prefix('warga')->group(function() {
    Route::get('/', 'WargaController@index');
    Route::post('/store', [WargaController::class,'store']);
    Route::get('/edit/{nik}', [WargaController::class,'edit']);
    Route::post('/update/{nik}', [WargaController::class,'update']);
    Route::get('/destroy/{nik}', [WargaController::class,'destroy']);
});

