<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

Route::get('/', 'ClientController@getPagination')->name('home');
Route::get('clients', 'ClientController@getCreatePage');
Route::get('autos', 'AutoController@getCreatePage');
Route::get('autos/{id}', 'AutoController@getAutoWithClient');
Route::post('autos', 'AutoController@postAuto');
Route::post('clients', 'ClientController@postClientWithAutos');
Route::put('autos/{id}', 'AutoController@putAutoWithClient');
Route::get('autos/delete/{id}', 'AutoController@Delete');
