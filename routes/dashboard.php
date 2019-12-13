<?php

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('home');

Route::prefix('dashboard')->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');

    Route::resource('files', 'FileController')->except([
        'index', 'create', 'destroy', 'edit', 'update'
    ]);
    Route::get('/files/create/{post_id}', 'FileController@create')->name('files.create');
    Route::patch('/files/update/{post_id}', 'FileController@update')->name('files.update');

    /*============ Comments ===============*/
    Route::get('/comments/{id}', 'CommentController@index')->name('comments.index');
    Route::get('/comments/{id}/edit', 'CommentController@edit')->name('comments.edit');
    Route::patch('/comments/{id}/update', 'CommentController@update')->name('comments.update');
    Route::delete('/comments/{id}/destroy', 'CommentController@destroy')->name('comments.destroy');

    Route::get('/errors/unauthorized', 'ErrorController@unauthorized')->name('errors.unauthorized');
});

Route::group(['middleware' => ['auth', 'role:1'], 'prefix' => 'dashboard'], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('regions', 'RegionController');



    Route::resource('configurations', 'ConfigurationController')->except([
        'store', 'create', 'destroy'
    ]);

    Route::get('/log-users', 'LogUserController@index')->name('log-users');

    /*============ User Role ===============*/
    Route::get('/user_role/create/{user_id}', 'UserRoleController@create')->name('user_role.create');
    Route::post('/user_role/store', 'UserRoleController@store')->name('user_role.store');

    /*============ Permission Role ===============*/
    Route::get('/permission_role/create/{user_id}', 'PermissionRoleController@create')->name('permission_role.create');
    Route::post('/permission_role/store', 'PermissionRoleController@store')->name('permission_role.store');

    /*============ Permissions ===============*/
    Route::get('/permissions', 'PermissionController@index')->name('permissions.index');
});
