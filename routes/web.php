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
Route::post('files/export/{id}', 'FileController@export');
Route::post('files/delete/{id}', 'FileController@destroy');


Auth::routes();

Route::post('/postimage', 'MetaController@getimage');

Route::post('/post', 'MetaController@iptc');

Route::get('/iptc', 'MetaController@index');