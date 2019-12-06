<?php

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('home');

Route::prefix('dashboard')->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('regions', 'RegionController');

    Route::resource('files', 'FileController')->except([
        'index', 'create', 'destroy'
    ]);

    Route::resource('configurations', 'ConfigurationController')->except([
        'store', 'create', 'destroy'
    ]);

    Route::get('/files/create/{post_id}', 'FileController@create')->name('files.create');
    Route::delete('/files/destroy/{id}/{post_id}', 'FileController@destroy')->name('files.destroy');
    Route::get('/log-users', 'LogUserController@index')->name('log-users');

    /*============ User Role ===============*/
    Route::get('/user_role/create/{user_id}', 'UserRoleController@create')->name('user_role.create');
    Route::post('/user_role/store', 'UserRoleController@store')->name('user_role.store');

    /*============ Permission Role ===============*/
    Route::get('/permission_role/create/{user_id}', 'PermissionRoleController@create')->name('permission_role.create');
    Route::post('/permission_role/store', 'PermissionRoleController@store')->name('permission_role.store');

    /*============ Comments ===============*/
    Route::get('/comments/{id}', 'CommentController@index')->name('comments.index');
    Route::get('/comments/{id}/edit', 'CommentController@edit')->name('comments.edit');
    Route::patch('/comments/{id}/update', 'CommentController@update')->name('comments.update');
    Route::delete('/comments/{id}/destroy', 'CommentController@destroy')->name('comments.destroy');
});
