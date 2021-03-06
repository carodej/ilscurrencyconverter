<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', array('as' => 'index', 'uses' => 'CurrencyConverterController@index'));
Route::post('/', array('as' => 'performConversion', 'uses' => 'CurrencyConverterController@performConversion'));