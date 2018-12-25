<?php
/**
 * PREFIX: admin/user
 */
Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'Backend\UsersController@index')
        ->name('user.list');
    Route::get('create', 'Backend\UsersController@create')
        ->name('user.create');
    Route::post('create', 'Backend\UsersController@store')
        ->name('user.store');
    Route::get('show/{user}', 'Backend\UsersController@view')
        ->name('user.show');
    Route::get('edit/{user}', 'Backend\UsersController@edit')
        ->name('user.edit');
    Route::put('update/details/{user}', 'Backend\UsersController@updateDetails')
        ->name('user.update.details');
    Route::put('update/login-details/{user}', 'Backend\UsersController@updateLoginDetails')
        ->name('user.update.login-details');
    Route::delete('delete', 'Backend\UsersController@delete')
        ->name('user.delete');
    Route::post('update/avatar/{user}', 'Backend\UsersController@updateAvatar')
        ->name('user.update.avatar');
    Route::post('update/avatar/external/{user}', 'Backend\UsersController@updateAvatarExternal')
        ->name('user.update.avatar.external');
    Route::get('sessions/{user}', 'Backend\UsersController@sessions')
        ->name('user.sessions');
    Route::delete('sessions/{user}/invalidate/{session}', 'Backend\UsersController@invalidateSession')
        ->name('user.sessions.invalidate');
	Route::post('export', 'Backend\UsersController@export')
		->name('user.export');
});
