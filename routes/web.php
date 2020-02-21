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
Route::get('/', 'SystemController@form')->name('form');
Route::post('/import', 'SystemController@import')->name('import');
Route::get('/report', 'SystemController@report')->name('report');
