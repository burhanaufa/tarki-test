<?php

/*
|--------------------------------------------------------------------------
| Landing page Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('/');
Route::get('/lists/{slug}', 'HomeController@lists')->name('lists');
Route::get('/detail_post/{slug}', 'HomeController@detail_post')->name('detail_post');
Route::get('/page/{slug}', 'HomeController@page')->name('page');
Route::post('/add_comment/{id}', 'HomeController@add_comment')->name('add_comment');