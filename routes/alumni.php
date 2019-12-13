<?php

/*
|--------------------------------------------------------------------------
| Alumni Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/alumni', 'AlumniController@index')->name('alumni');
Route::post('/alumni/login', 'AlumniController@login')->name('alumni-login');
Route::get('/alumni/logout', 'AlumniController@logout')->name('alumni-logout');
Route::get('/alumni/dashboard', 'AlumniController@dashboard')->name('alumni-dashboard');
Route::get('/alumni/search_alumni', 'AlumniController@search')->name('search-alumni');
Route::get('/alumni/detail_alumni/{nis}', 'AlumniController@detail')->name('detail-alumni');
