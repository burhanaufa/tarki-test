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
Route::get('/user_role/create/{user_id}', 'UserRoleController@create')->name('user_role.create');
Route::post('/user_role/store', 'UserRoleController@store')->name('user_role.store');
Route::delete('/files/destroy/{id}/{post_id}', 'FileController@destroy')->name('files.destroy');
