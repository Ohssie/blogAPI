<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/blog', 'BlogController@index');
Route::post('/blog', 'BlogController@store');
Route::get('/blog/{id}', 'BlogController@show');
Route::post('/blog/{id}', 'BlogController@update');
Route::delete('/blog/{id}', 'BlogController@destroy');
