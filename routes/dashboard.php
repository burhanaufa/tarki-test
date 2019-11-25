<?php

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('posts', 'PostController');
