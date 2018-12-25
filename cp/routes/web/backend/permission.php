<?php
/**
 * PREFIX: admin/role   admin/permission
 */
Route::group(['prefix' =>'role'], function () {
	Route::get('/', 'Backend\RolesController@index')
        ->name('role.index');
    Route::get('create', 'Backend\RolesController@create')
        ->name('role.create');
    Route::post('store', 'Backend\RolesController@store')
        ->name('role.store');
	Route::get('view/{role}', 'Backend\RolesController@view')
		->name('role.view');
    Route::get('edit/{role}', 'Backend\RolesController@edit')
        ->name('role.edit');
    Route::put('update/{role}', 'Backend\RolesController@update')
        ->name('role.update');
    Route::delete('delete', 'Backend\RolesController@delete')
        ->name('role.delete');
	Route::post('export', 'Backend\RolesController@export')
		->name('role.export');
});

// Manage permissions prefix : admin
Route::post('permission/save', 'Backend\PermissionsController@saveRolePermissions')
    ->name('permission.save');
Route::resource('permission', 'Backend\PermissionsController');