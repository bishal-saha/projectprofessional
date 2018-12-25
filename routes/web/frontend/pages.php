<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 21/12/18
 * Time: 10:29 PM
 */

Route::get('/terms-and-conditions', 'Frontend\PageController@create')
	->name('terms.and.conditions');

Route::get('/cookie-policy', function () {
	return view('welcome');
})->name('cookie.policy');