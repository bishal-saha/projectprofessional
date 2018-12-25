<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 29/11/18
 * Time: 7:40 PM
 */

/**
 * PREFIX: admin
 */
Route::get('/', 'Backend\DashboardController@index')
    ->name('admin');
Route::get('/dashboard', 'Backend\DashboardController@index')
    ->name('admin.dashboard');

Route::get('my/profile', 'Backend\ProfileController@index')
    ->name('my.profile');

Route::get('my/activities', 'Backend\ProfileController@activity')
    ->name('my.activities');

Route::put('update/my/profile/details', 'Backend\ProfileController@updateDetails')
    ->name('update.my.profile.details');

Route::post('update/my/avatar', 'Backend\ProfileController@updateAvatar')
    ->name('update.my.avatar');

Route::post('update/my/avatar/external', 'Backend\ProfileController@updateAvatarExternal')
	->name('update.my.avatar.external');

Route::put('update/my/login-details', 'Backend\ProfileController@updateLoginDetails')
    ->name('update.my.login-details');

Route::get('my/sessions', 'Backend\ProfileController@sessions')
    ->name('my.sessions');

Route::delete('invalidate/my/sessions/{session}', 'Backend\ProfileController@invalidateSession')
    ->name('invalidate.my.sessions');