<?php
/**
 * PREFIX: admin/activity
 */
Route::group(['prefix' => 'activity'], function () {
    Route::get('/', 'Backend\ActivityController@index')
        ->name('activity.index');
    Route::get('user/{user}/log', 'Backend\ActivityController@userActivity')
        ->name('activity.user');
});