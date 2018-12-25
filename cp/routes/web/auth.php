<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 26/11/18
 * Time: 9:27 PM
 */

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm')
	->name('login');
Route::post('post-login', 'Auth\AuthController@postLoginForm')
	->name('post.login');
Route::get('logout', 'Auth\AuthController@getLogout')
	->name('logout');

// Register password reset routes only if it is enabled inside website settings.
if (setting('forgot_password')) {
    Route::get('password/remind', 'Auth\PasswordController@forgotPassword')
		->name('password.remind');
    Route::post('password/remind', 'Auth\PasswordController@sendPasswordReminder')
		->name('send.password.reminder');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset')
		->name('password.reset.token');
    Route::post('password/reset', 'Auth\PasswordController@postReset')
		->name('post.password.reset');
}

// Allow registration routes only if registration is enabled.
if (setting('reg_enabled')) {
    Route::get('signup', 'Auth\AuthController@showRegistrationForm')
		->name('registration');
    Route::post('signup', 'Auth\AuthController@postRegistrationForm');
    Route::get('signup/confirmation/{token}', 'Auth\AuthController@confirmEmail')
		->name('confirm.registration.email');
}
