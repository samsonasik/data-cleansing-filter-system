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

Route::post('/import', 'SystemController@import')
    ->name('import')
    ->middleware([
        // import to customers table
        App\Http\Middleware\CustomerImport::class,

        // pull customers data from db and set to "customers" attributes in Request instance
        App\Http\Middleware\SetCustomersAttribute::class,

        // filtering data that need to be cleaned
        App\Http\Middleware\CustomerTitle::class,
        App\Http\Middleware\CustomerName::class,

        // finally, save log data cleansing if any errors
        App\Http\Middleware\CustomerLogDataCleansing::class,
    ]);

Route::get('/report', 'SystemController@report')->name('report');
Route::get('/delete', 'SystemController@delete')->name('delete');
