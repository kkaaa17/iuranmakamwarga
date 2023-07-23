<?php

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

Route::prefix('iuran')->group(function() {
    Route::get('/', 'IuranController@index');
    Route::post('/store', 'IuranController@store');
    Route::get('/destroy/{id}', 'IuranController@destroy');
});
