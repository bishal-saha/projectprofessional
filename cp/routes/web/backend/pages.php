<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 21/12/18
 * Time: 10:04 PM
 */

Route::group(['prefix' => 'pages'], function () {
	Route::get('/', 'Backend\PagesController@index')
		->name('page.index');
	Route::get('create', 'Backend\PagesController@create')
		->name('page.create');
	Route::post('create', 'Backend\PagesController@store')
		->name('page.store');
	Route::get('view/{slug}', 'Backend\PagesController@view')
		->name('page.view');
	Route::get('edit/{slug}', 'Backend\PagesController@edit')
		->name('page.edit');
	Route::put('update/{slug}', 'Backend\PagesController@update')
		->name('page.update');
	Route::delete('delete', 'Backend\PagesController@delete')
		->name('page.delete');
	Route::post('export', 'Backend\PagesController@export')
		->name('page.export');

	Route::post('slug-suggestion', 'Backend\PagesController@getSlugSuggestion')
		->name('page.slug.suggestion');
});