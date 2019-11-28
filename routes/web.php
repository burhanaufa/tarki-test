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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'HomeController@index')->name('/');
Route::get('/lists/{id}', 'HomeController@lists')->name('lists');
Route::get('/page/{id}', 'HomeController@page')->name('page');
Route::get('/alumni', 'HomeController@alumni')->name('alumni');

/*====== Admin Routes ======*/
require __DIR__.'/dashboard.php';

/*====== Alumni Routes ======*/
require __DIR__.'/alumni.php';
