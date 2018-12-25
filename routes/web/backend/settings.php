<?php
/**
 * PREFIX: admin/settings
 */
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'Backend\SettingsController@general')->middleware('permission:settings.general')
        ->name('settings.general');
    Route::post('general', 'Backend\SettingsController@update')->middleware('permission:settings.general')
        ->name('settings.general.update');
    Route::get('auth', 'Backend\SettingsController@auth')->middleware('permission:settings.auth')
        ->name('settings.auth');
    Route::post('auth', 'Backend\SettingsController@update')->middleware('permission:settings.auth')
        ->name('settings.auth.update');
    Route::post('auth/registration/captcha/enable', 'Backend\SettingsController@enableCaptcha')->middleware('permission:settings.auth')
        ->name('settings.registration.captcha.enable');
    Route::post('auth/registration/captcha/disable', 'Backend\SettingsController@disableCaptcha')->middleware('permission:settings.auth')
        ->name('settings.registration.captcha.disable');
    Route::get('notifications', 'Backend\SettingsController@notifications')->middleware('permission:settings.notifications')
        ->name('settings.notifications');
    Route::post('notifications', 'Backend\SettingsController@update')->middleware('permission:settings.notifications')
        ->name('settings.notifications.update');
});
