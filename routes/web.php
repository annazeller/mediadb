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

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/files/{type}/{id?}', 'FileController@index');

Route::post('files/add', 'FileController@store');
Route::post('files/edit/{id}', 'FileController@edit');
Route::post('files/delete/{id}', 'FileController@destroy');

Route::get('/search', 'SearchController@search');

Auth::routes();
