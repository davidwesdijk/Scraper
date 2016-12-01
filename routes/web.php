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

Route::get('/', 'ScraperController@create');
Route::get('/history', 'ScraperController@index');
Route::get('/history/{id}', 'ScraperController@show');

Route::post('/create', 'ScraperController@store');
Route::post('/history', 'ScraperController@redirectKeyword');