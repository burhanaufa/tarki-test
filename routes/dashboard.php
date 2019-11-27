<?php

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('posts', 'PostController');
Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');

Route::resource('files', 'FileController')->except([
    'index', 'create', 'destroy'
]);

Route::get('/files/create/{post_id}', 'FileController@create')->name('files.create');
Route::delete('/files/destroy/{id}/{post_id}', 'FileController@destroy')->name('files.destroy');
