<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/', 'Frontend\PageController@showHome')->name('home');

require_once 'web/auth.php';		// Routes for login, logout, forgot password and registration.

Route::group(['middleware' => 'auth'], function () {
    require_once 'web/frontend/user.php';		// Routes for Users Dashboard, My Profile
});

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function () {
    require_once 'web/backend/admin.php';		// Routes for dashboard,

	require_once 'web/backend/pages.php';			// Routes for content management system.

    require_once 'web/backend/permission.php';	// Routes for roles & permissions

    require_once 'web/backend/users.php';		// Routes for user CRUD, avatar, session

    require_once 'web/backend/activity.php';	// Routes for user activities

    require_once 'web/backend/settings.php';	// Routes for General, Auth & Registration settings.
});

Route::get('{slug}', 'Frontend\PageController@showContent')->name('frontend.page');