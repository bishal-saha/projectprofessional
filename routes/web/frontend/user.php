<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 29/11/18
 * Time: 8:00 PM
 */

Route::get('/dashboard', 'Frontend\DashboardController@index')
    ->name('userDashboard');